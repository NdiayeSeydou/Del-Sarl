<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proforma;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProformaController extends Controller
{
    private function buildNumero(string $prefix = 'PRO'): string
    {
        $annee = now()->year;

        // Créer la séquence de l'année si elle n'existe pas
        DB::table('proforma_sequences')->insertOrIgnore([
            'annee' => $annee,
            'dernier_numero' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Verrouiller la séquence pour éviter les doublons en cas
        // de créations simultanées
        $sequence = DB::table('proforma_sequences')
            ->where('annee', $annee)
            ->lockForUpdate()
            ->first();

        // Rechercher le plus grand numéro déjà attribué pour cette année
        $dernierNumeroExistant = Proforma::where('num_proforma', 'like', "{$prefix}-{$annee}-%")
            ->selectRaw("MAX(CAST(SPLIT_PART(num_proforma, '-', 3) AS INTEGER)) as dernier_numero")
            ->value('dernier_numero');

        $dernierNumeroExistant = (int) ($dernierNumeroExistant ?? 0);

        // Comparer le compteur et les numéros déjà enregistrés
        $dernierNumero = max(
            (int) $sequence->dernier_numero,
            $dernierNumeroExistant
        );

        // Générer le numéro suivant
        $nouveauNumero = $dernierNumero + 1;

        // Mettre à jour la séquence
        DB::table('proforma_sequences')
            ->where('annee', $annee)
            ->update([
                'dernier_numero' => $nouveauNumero,
                'updated_at' => now(),
            ]);

        return sprintf('%s-%d-%04d', $prefix, $annee, $nouveauNumero);
    }

    public function index(Request $request)
{
    $query = Proforma::query();

    // Recherche par numéro de proforma ou client
    if ($request->filled('search')) {
        $search = trim($request->search);

        $query->where(function ($q) use ($search) {
            $q->where('num_proforma', 'like', "%{$search}%")
                ->orWhere('client', 'like', "%{$search}%");
        });
    }

    // Filtrage par date
    if ($request->filled('date')) {
        $query->whereDate('date_proforma', $request->date);
    }

    // Pagination : 22 proformas par page
    $proformas = $query
        ->orderByDesc('date_proforma')
        ->paginate(22)
        ->withQueryString();

    return view('admin.proforma.index', compact('proformas'));
}

    public function create()
    {
        return view('admin.proforma.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client' => ['required', 'string', 'max:255'],
            'date_proforma' => ['required', 'date'],
            'devise' => ['nullable', 'string', 'max:3'],
            'appliquer_tva' => ['nullable', 'boolean'],
            'tva_pourcentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'appliquer_remise' => ['nullable', 'boolean'],
            'remise_pourcentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'remarques' => ['nullable', 'string'],
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

        $proforma = DB::transaction(function () use (
            $validated,
            $subtotalHt,
            $tvaPourcentage,
            $remisePourcentage,
            $montantRemise,
            $montantTva,
            $grandTotal
        ) {
            $proforma = Proforma::create([
                'client' => $validated['client'],
                'num_proforma' => $this->buildNumero('PRO'),
                'date_proforma' => $validated['date_proforma'],
                'devise' => $validated['devise'] ?? 'XOF',
                'appliquer_tva' => (bool) ($validated['appliquer_tva'] ?? false),
                'tva_pourcentage' => $tvaPourcentage,
                'appliquer_remise' => (bool) ($validated['appliquer_remise'] ?? false),
                'remise_pourcentage' => $remisePourcentage,
                'subtotal_ht' => round($subtotalHt, 2),
                'montant_remise' => round($montantRemise, 2),
                'montant_tva' => round($montantTva, 2),
                'grand_total' => round($grandTotal, 2),
                'remarques' => $validated['remarques'] ?? null,
            ]);

            foreach ($validated['articles'] as $article) {
                $proforma->articles()->create([
                    'designation' => $article['designation'],
                    'quantite' => (int) $article['quantite'],
                    'prix_unitaire' => (float) $article['prix_unitaire'],
                    'prix_total' => round(
                        (float) $article['quantite'] * (float) $article['prix_unitaire'],
                        2
                    ),
                ]);
            }

            return $proforma;
        });

        return redirect()
            ->route('proforma.show', $proforma)
            ->with('success', 'Proforma enregistrée avec succès.');
    }

    public function show(Proforma $proforma)
    {
        return view('admin.proforma.show', compact('proforma'));
    }

    public function edit(Proforma $proforma)
    {
        return view('admin.proforma.edit', compact('proforma'));
    }

    public function update(Request $request, Proforma $proforma)
    {
        // 1. Validation des données
        $validated = $request->validate([
            'client' => ['required', 'string', 'max:255'],
            'date_proforma' => ['required', 'date'],
            'devise' => ['nullable', 'string', 'max:3'],
            'appliquer_tva' => ['nullable', 'boolean'],
            'tva_pourcentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'appliquer_remise' => ['nullable', 'boolean'],
            'remise_pourcentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'remarques' => ['nullable', 'string'],
            'articles' => ['required', 'array', 'min:1'],
            'articles.*.designation' => ['required', 'string'],
            'articles.*.quantite' => ['required', 'integer', 'min:1'],
            'articles.*.prix_unitaire' => ['required', 'numeric', 'min:0'],
        ]);

        // 2. Récupérer les articles existants
        $proforma->load('articles');

        // 3. Préparer les données actuelles
        $donneesActuelles = [
            'client' => $proforma->client,
            'date_proforma' => Carbon::parse($proforma->date_proforma)->format('Y-m-d'),
            'devise' => $proforma->devise,
            'appliquer_tva' => (bool) $proforma->appliquer_tva,
            'tva_pourcentage' => (float) $proforma->tva_pourcentage,
            'appliquer_remise' => (bool) $proforma->appliquer_remise,
            'remise_pourcentage' => (float) $proforma->remise_pourcentage,
            'remarques' => $proforma->remarques,
        ];

        // 4. Préparer les nouvelles données
        $donneesEnvoyees = [
            'client' => $validated['client'],
            'date_proforma' => $validated['date_proforma'],
            'devise' => $validated['devise'] ?? 'XOF',
            'appliquer_tva' => (bool) ($validated['appliquer_tva'] ?? false),
            'tva_pourcentage' => (float) ($validated['tva_pourcentage'] ?? 18),
            'appliquer_remise' => (bool) ($validated['appliquer_remise'] ?? false),
            'remise_pourcentage' => (float) ($validated['remise_pourcentage'] ?? 0),
            'remarques' => $validated['remarques'] ?? null,
        ];

        // 5. Comparer les anciens articles
        $articlesActuels = $proforma->articles
            ->map(function ($article) {
                return [
                    'designation' => trim($article->designation),
                    'quantite' => (int) $article->quantite,
                    'prix_unitaire' => (float) $article->prix_unitaire,
                ];
            })
            ->values()
            ->toArray();

        // 6. Comparer les nouveaux articles
        $articlesEnvoyes = collect($validated['articles'])
            ->map(function ($article) {
                return [
                    'designation' => trim($article['designation']),
                    'quantite' => (int) $article['quantite'],
                    'prix_unitaire' => (float) $article['prix_unitaire'],
                ];
            })
            ->values()
            ->toArray();

        // 7. Vérifier si une modification a été effectuée
        if (
            $donneesActuelles === $donneesEnvoyees
            && $articlesActuels === $articlesEnvoyes
        ) {
            return redirect()
                ->route('proforma.show', $proforma)
                ->with('info', 'Aucune modification détectée. Les données sont déjà à jour.');
        }

        // 8. Recalculer les montants
        $subtotalHt = collect($validated['articles'])->sum(function ($article) {
            return (float) $article['quantite'] * (float) $article['prix_unitaire'];
        });

        $tvaPourcentage = (float) ($validated['tva_pourcentage'] ?? 18);
        $remisePourcentage = (float) ($validated['remise_pourcentage'] ?? 0);

        $montantRemise = ($validated['appliquer_remise'] ?? false)
            ? $subtotalHt * ($remisePourcentage / 100)
            : 0;

        $montantTva = ($validated['appliquer_tva'] ?? false)
            ? ($subtotalHt - $montantRemise) * ($tvaPourcentage / 100)
            : 0;

        $grandTotal = $subtotalHt - $montantRemise + $montantTva;

        // 9. Enregistrer les modifications dans une transaction
        DB::transaction(function () use (
            $proforma,
            $validated,
            $subtotalHt,
            $tvaPourcentage,
            $remisePourcentage,
            $montantRemise,
            $montantTva,
            $grandTotal
        ) {
            // Mettre à jour la proforma
            $proforma->update([
                'client' => $validated['client'],
                'date_proforma' => $validated['date_proforma'],
                'devise' => $validated['devise'] ?? 'XOF',
                'appliquer_tva' => (bool) ($validated['appliquer_tva'] ?? false),
                'tva_pourcentage' => $tvaPourcentage,
                'appliquer_remise' => (bool) ($validated['appliquer_remise'] ?? false),
                'remise_pourcentage' => $remisePourcentage,
                'subtotal_ht' => round($subtotalHt, 2),
                'montant_remise' => round($montantRemise, 2),
                'montant_tva' => round($montantTva, 2),
                'grand_total' => round($grandTotal, 2),
                'remarques' => $validated['remarques'] ?? null,
            ]);

            // Supprimer les anciens articles
            $proforma->articles()->delete();

            // Enregistrer les nouveaux articles
            foreach ($validated['articles'] as $article) {
                $proforma->articles()->create([
                    'designation' => $article['designation'],
                    'quantite' => (int) $article['quantite'],
                    'prix_unitaire' => (float) $article['prix_unitaire'],
                    'prix_total' => round(
                        (float) $article['quantite'] * (float) $article['prix_unitaire'],
                        2
                    ),
                ]);
            }
        });

        // 10. Redirection après modification
        return redirect()
            ->route('proforma.show', $proforma)
            ->with('success', 'Proforma mise à jour avec succès.');
    }

    public function destroy(Proforma $proforma)
    {
        $proforma->delete();

        return redirect()->route('proforma.index')->with('success', 'Proforma supprimée.');
    }
}
