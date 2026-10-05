<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FactureController extends Controller
{
    private function buildNumero(string $prefix = 'FAC'): string
{
    $annee = (int) now()->year;

    // Créer le compteur de l'année s'il n'existe pas.
    DB::table('facture_sequences')->insertOrIgnore([
        'annee' => $annee,
        'dernier_numero' => 0,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Verrouiller le compteur pendant la transaction.
    $sequence = DB::table('facture_sequences')
        ->where('annee', $annee)
        ->lockForUpdate()
        ->first();

    // Rechercher le plus grand numéro déjà attribué cette année.
    $dernierNumeroExistant = Facture::where(
        'num_facture',
        'like',
        $prefix . '-' . $annee . '-%'
    )
        ->selectRaw("
            MAX(
                CAST(
                    SUBSTRING(num_facture FROM '[0-9]+$')
                    AS INTEGER
                )
            ) AS dernier_numero
        ")
        ->value('dernier_numero');

    // Prendre le plus grand numéro entre le compteur et les factures existantes.
    $nouveauNumero = max(
        (int) ($sequence->dernier_numero ?? 0),
        (int) ($dernierNumeroExistant ?? 0)
    ) + 1;

    // Mettre à jour le compteur.
    DB::table('facture_sequences')
        ->where('annee', $annee)
        ->update([
            'dernier_numero' => $nouveauNumero,
            'updated_at' => now(),
        ]);

    return sprintf('%s-%d-%04d', $prefix, $annee, $nouveauNumero);
}
    public function index(Request $request)
    {
        $query = Facture::query();

        // Recherche par numéro de facture ou nom du client
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('num_facture', 'like', "%{$search}%")
                    ->orWhere('client', 'like', "%{$search}%");
            });
        }

        // Filtrage par date
        if ($request->filled('date')) {
            $query->whereDate('date_facture', $request->date);
        }

        // Pagination de 22 factures par page
        $factures = $query
            ->orderByDesc('date_facture')
            ->paginate(22)
            ->withQueryString();

        return view('admin.factures.index', compact('factures'));
    }

    public function create()
    {
        return view('admin.factures.create');
    }

    public function store(Request $request)
    {
        // 1. Nettoyage des espaces de milliers D'ABORD (avant la validation)
        if ($request->has('articles') && is_array($request->articles)) {
            $articles = $request->articles;
            foreach ($articles as $i => $art) {
                if (isset($art['prix_unitaire'])) {
                    // Supprime tous les espaces (y compris les espaces insécables HTML &nbsp;)
                    $articles[$i]['prix_unitaire'] = preg_replace('/\s+/u', '', $art['prix_unitaire']);
                }
            }
            $request->merge(['articles' => $articles]);
        }

        // 2. Normalisation du montant payé si renseigné avec séparateur de milliers
        if ($request->filled('montant_paye')) {
            $request->merge([
                'montant_paye' => preg_replace('/\s+/u', '', $request->montant_paye),
            ]);
        }

        // 3. Normalisation des switches (TVA / Remise)
        $request->merge([
            'appliquer_tva' => $request->has('appliquer_tva'),
            'appliquer_remise' => $request->has('appliquer_remise'),
        ]);

        // 4. Validation avec messages en Français
        $validated = $request->validate([
            'client' => ['required', 'string', 'max:255'],
            'date_facture' => ['required', 'date'],
            'date_echeance' => ['nullable', 'date'],
            'statut_paiement' => ['required', 'in:unpaid,paid,partial'],
            'montant_paye' => ['nullable', 'required_if:statut_paiement,partial', 'numeric', 'min:0'],
            'appliquer_tva' => ['nullable', 'boolean'],
            'tva_pourcentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'appliquer_remise' => ['nullable', 'boolean'],
            'remise_pourcentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'conditions' => ['nullable', 'string'],
            'montant_lettres' => ['nullable', 'string'],
            'articles' => ['required', 'array', 'min:1'],
            'articles.*.designation' => ['required', 'string'],
            'articles.*.quantite' => ['required', 'integer', 'min:1'],
            'articles.*.prix_unitaire' => ['required', 'numeric', 'min:0'],
        ], [
            // Messages généraux
            'client.required' => 'Le champ client est obligatoire.',
            'date_facture.required' => 'La date d\'émission est requise.',
            'statut_paiement.required' => 'Veuillez sélectionner un statut de paiement.',
            'montant_paye.required_if' => 'Le montant réglé est obligatoire pour un paiement partiel.',
            'montant_paye.numeric' => 'Le montant réglé doit être un nombre valide.',
            'articles.required' => 'Vous devez ajouter au moins un article.',
            'articles.min' => 'La facture doit contenir au moins un article.',

            // Messages sur les articles (* représente la ligne)
            'articles.*.designation.required' => 'La désignation de l\'article est obligatoire.',
            'articles.*.quantite.required' => 'La quantité est requise.',
            'articles.*.quantite.integer' => 'La quantité doit être un nombre entier.',
            'articles.*.quantite.min' => 'La quantité doit être au moins égale à 1.',
            'articles.*.prix_unitaire.required' => 'Le prix unitaire est obligatoire.',
            'articles.*.prix_unitaire.numeric' => 'Le prix unitaire doit être un nombre valide.',
            'articles.*.prix_unitaire.min' => 'Le prix unitaire ne peut pas être négatif.',
        ]);

        // 5. Calculs financiers
        $subtotalHt = collect($validated['articles'])->sum(function ($article) {
            return (float) $article['quantite'] * (float) $article['prix_unitaire'];
        });

        $tvaPourcentage = $validated['appliquer_tva'] ? (float) ($validated['tva_pourcentage'] ?? 18) : 0;
        $remisePourcentage = $validated['appliquer_remise'] ? (float) ($validated['remise_pourcentage'] ?? 0) : 0;

        $montantRemise = $validated['appliquer_remise'] ? $subtotalHt * ($remisePourcentage / 100) : 0;
        $netHt = $subtotalHt - $montantRemise;
        $montantTva = $validated['appliquer_tva'] ? $netHt * ($tvaPourcentage / 100) : 0;
        $grandTotal = $netHt + $montantTva;

        $montantPaye = 0;
        if ($validated['statut_paiement'] === 'paid') {
            $montantPaye = $grandTotal;
        } elseif ($validated['statut_paiement'] === 'partial') {
            $montantPaye = (float) $validated['montant_paye'];
        }

        // 6. Insertion en BDD avec transaction
        $facture = DB::transaction(function () use ($validated, $subtotalHt, $tvaPourcentage, $remisePourcentage, $montantRemise, $montantTva, $grandTotal, $montantPaye) {

            $facture = Facture::create([
                'client' => $validated['client'],
                'num_facture' => $this->buildNumero('FAC'),
                'date_facture' => $validated['date_facture'],
                'date_echeance' => $validated['date_echeance'] ?? null,
                'statut_paiement' => $validated['statut_paiement'],
                'montant_paye' => round($montantPaye, 2),
                'appliquer_tva' => $validated['appliquer_tva'],
                'tva_pourcentage' => $tvaPourcentage,
                'appliquer_remise' => $validated['appliquer_remise'],
                'remise_pourcentage' => $remisePourcentage,
                'subtotal_ht' => round($subtotalHt, 2),
                'montant_remise' => round($montantRemise, 2),
                'montant_tva' => round($montantTva, 2),
                'grand_total' => round($grandTotal, 2),
                'montant_lettres' => $validated['montant_lettres'] ?? null,
                'conditions' => $validated['conditions'] ?? null,
            ]);

            foreach ($validated['articles'] as $article) {
                $facture->articles()->create([
                    'designation' => $article['designation'],
                    'quantite' => (int) $article['quantite'],
                    'prix_unitaire' => (float) $article['prix_unitaire'],
                    'prix_total' => round(
                        (float) $article['quantite'] * (float) $article['prix_unitaire'],
                        2
                    ),
                ]);
            }

            return $facture;
        });

        return redirect()
            ->route('facture.show', $facture)
            ->with('success', 'Facture enregistrée avec succès.');
    }

    public function show(Facture $facture)
    {
        return view('admin.factures.show', compact('facture'));
    }

    public function edit(Facture $facture)
    {
        return view('admin.factures.edit', compact('facture'));
    }

    public function update(Request $request, Facture $facture)
    {
        $validated = $request->validate([
            'client' => ['required', 'string', 'max:255'],
            'date_facture' => ['required', 'date'],
            'date_echeance' => ['nullable', 'date'],
            'statut_paiement' => ['nullable', 'in:unpaid,paid,partial'],
            'appliquer_tva' => ['nullable', 'boolean'],
            'tva_pourcentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'appliquer_remise' => ['nullable', 'boolean'],
            'remise_pourcentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'conditions' => ['nullable', 'string'],
            'articles' => ['required', 'array', 'min:1'],
            'articles.*.designation' => ['required', 'string'],
            'articles.*.quantite' => ['required', 'integer', 'min:1'],
            'articles.*.prix_unitaire' => ['required', 'numeric', 'min:0'],
        ]);

        $subtotalHt = collect($validated['articles'])->sum(function ($article) {
            return (float) $article['quantite'] * (float) $article['prix_unitaire'];
        });

        $tvaPourcentage = (float) ($validated['tva_pourcentage'] ?? 18);
        $remisePourcentage = (float) ($validated['remise_pourcentage'] ?? 0);
        $montantRemise = $validated['appliquer_remise'] ?? false ? $subtotalHt * ($remisePourcentage / 100) : 0;
        $montantTva = $validated['appliquer_tva'] ?? false ? ($subtotalHt - $montantRemise) * ($tvaPourcentage / 100) : 0;
        $grandTotal = $subtotalHt - $montantRemise + $montantTva;

        $facture->update([
            'client' => $validated['client'],
            'date_facture' => $validated['date_facture'],
            'date_echeance' => $validated['date_echeance'] ?? null,
            'statut_paiement' => $validated['statut_paiement'] ?? 'unpaid',
            'appliquer_tva' => (bool) ($validated['appliquer_tva'] ?? false),
            'tva_pourcentage' => $tvaPourcentage,
            'appliquer_remise' => (bool) ($validated['appliquer_remise'] ?? false),
            'remise_pourcentage' => $remisePourcentage,
            'subtotal_ht' => round($subtotalHt, 2),
            'montant_remise' => round($montantRemise, 2),
            'montant_tva' => round($montantTva, 2),
            'grand_total' => round($grandTotal, 2),
            'conditions' => $validated['conditions'] ?? null,
        ]);

        $facture->articles()->delete();

        foreach ($validated['articles'] as $article) {
            $facture->articles()->create([
                'designation' => $article['designation'],
                'quantite' => (int) $article['quantite'],
                'prix_unitaire' => (float) $article['prix_unitaire'],
                'prix_total' => round(((float) $article['quantite'] * (float) $article['prix_unitaire']), 2),
            ]);
        }

        return redirect()->route('facture.show', $facture)->with('success', 'Facture mise à jour.');
    }

    public function destroy(Facture $facture)
    {
        $facture->delete();

        return redirect()->route('facture.index')->with('success', 'Facture supprimée.');
    }
}
