<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bordereau;
use App\Models\BordereauCounter;
use App\Models\Proforma;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BordereauController extends Controller
{
    /**
     * Génère le prochain numéro de bordereau
     * sans réutiliser un numéro déjà existant.
     */
    private function buildNumero(string $prefix = 'BL'): string
    {
        $annee = (int) date('Y');

        $counter = BordereauCounter::where('annee', $annee)
            ->lockForUpdate()
            ->first();

        if (! $counter) {
            $counter = BordereauCounter::create([
                'annee' => $annee,
                'dernier_numero' => 0,
            ]);
        }

        $counter->increment('dernier_numero');

        return $prefix.'-'.$annee.'-'.str_pad(
            (string) $counter->dernier_numero,
            4,
            '0',
            STR_PAD_LEFT
        );
    }

    /**
     * Index
     */
   public function index(Request $request)
{
    $query = Bordereau::with(['articles', 'proforma']);

    // Recherche par numéro BL ou client
    if ($request->filled('search')) {
        $search = trim($request->search);

        $query->where(function ($q) use ($search) {
            $q->where('num_bl', 'like', "%{$search}%")
                ->orWhere('client', 'like', "%{$search}%");
        });
    }

    // Filtrage par date
    if ($request->filled('date')) {
        $query->whereDate('date_livraison', $request->date);
    }

    // Pagination : 22 bordereaux par page
    $bordereaux = $query
        ->orderByDesc('date_livraison')
        ->paginate(22)
        ->withQueryString();

    return view('admin.bordereau.index', compact('bordereaux'));
}

    /**
     * Formulaire de création
     */
    public function create()
    {
        $proformas = Proforma::with('articles')
            ->orderByDesc('date_proforma')
            ->get();

        $user = Auth::user();

        $annee = (int) date('Y');

        $counter = BordereauCounter::where('annee', $annee)->first();

        $prochainNumero = 'BL-'.$annee.'-'.str_pad(
            (string) (($counter?->dernier_numero ?? 0) + 1),
            4,
            '0',
            STR_PAD_LEFT
        );

        return view('admin.bordereau.create', compact(
            'proformas',
            'user',
            'prochainNumero'
        ));
    }

    /**
     * Enregistrement
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'proforma_id' => ['required', 'exists:proformas,id'],
            'date_livraison' => ['required', 'date'],
            'recepteur_nom' => ['nullable', 'string', 'max:255'],
            'recepteur_fonction' => ['nullable', 'string', 'max:255'],
            'articles' => ['required', 'array', 'min:1'],
            'articles.*.designation' => ['required', 'string'],
            'articles.*.quantite' => ['required', 'integer', 'min:1'],
            'articles.*.observations' => ['nullable', 'string'],
        ]);

        $user = Auth::user();

        return DB::transaction(function () use ($validated, $user) {

            $proforma = Proforma::with('articles')
                ->findOrFail($validated['proforma_id']);

            $numero = $this->buildNumero('BL');

            $reference = 'Facture du pro forma DEL SARL du '
                .Carbon::parse($proforma->date_proforma)->format('d/m/Y');

            $bordereau = Bordereau::create([
                'num_bl' => $numero,
                'proforma_id' => $proforma->id,
                'client' => $proforma->client,
                'date_livraison' => $validated['date_livraison'],
                'reference' => $reference,

                'emetteur_nom' => $user?->name ?? 'Système',
                'emetteur_fonction' => $user?->fonction ?? null,

                'recepteur_nom' => $validated['recepteur_nom'] ?? null,
                'recepteur_fonction' => $validated['recepteur_fonction'] ?? null,

                'total_quantite' => collect($validated['articles'])
                    ->sum('quantite'),
            ]);

            foreach ($validated['articles'] as $article) {
                $bordereau->articles()->create([
                    'designation' => $article['designation'],
                    'quantite' => (int) $article['quantite'],
                    'observations' => $article['observations'] ?? null,
                ]);
            }

            return redirect()
                ->route('bordereau.show', $bordereau)
                ->with('success', 'Bordereau enregistré avec succès.');
        });
    }

    /**
     * Affichage
     */
    public function show(Bordereau $bordereau)
    {
        $bordereau->load([
            'articles',
            'proforma',
        ]);

        return view('admin.bordereau.show', compact('bordereau'));
    }

    /**
     * Formulaire de modification
     */

    /**
     * Formulaire de modification
     */
    public function edit(Bordereau $bordereau)
    {
        $bordereau->load('articles', 'proforma');

        // On récupère les proformas avec leurs articles
        $proformas = Proforma::with('articles')
            ->orderByDesc('date_proforma')
            ->get();

        $user = Auth::user();

        return view('admin.bordereau.edit', compact(
            'bordereau',
            'proformas',
            'user'
        ));
    }

    /**
     * Modification
     */
    public function update(Request $request, Bordereau $bordereau)
    {
        $validated = $request->validate([
            'proforma_id' => [
                'required',
                'exists:proformas,id',
            ],

            'date_livraison' => [
                'required',
                'date',
            ],

            'recepteur_nom' => [
                'nullable',
                'string',
                'max:255',
            ],

            'recepteur_fonction' => [
                'nullable',
                'string',
                'max:255',
            ],

            'articles' => [
                'required',
                'array',
                'min:1',
            ],

            'articles.*.designation' => [
                'required',
                'string',
            ],

            'articles.*.quantite' => [
                'required',
                'integer',
                'min:1',
            ],

            'articles.*.observations' => [
                'nullable',
                'string',
            ],
        ]);

        $proforma = Proforma::with('articles')
            ->findOrFail($validated['proforma_id']);

        /*
         * La référence est générée automatiquement
         * à partir de la date de la proforma.
         *
         * Le client n'est PAS enregistré dans la référence.
         */
        $reference = 'Facture du pro forma DEL SARL du '
            .Carbon::parse($proforma->date_proforma)->format('d/m/Y');

        $user = Auth::user();

        DB::transaction(function () use (
            $bordereau,
            $validated,
            $proforma,
            $reference,
            $user
        ) {

            $bordereau->update([
                'date_livraison' => $validated['date_livraison'],

                'proforma_id' => $proforma->id,

                'reference' => $reference,

                'emetteur_nom' => $user->name,

                'emetteur_fonction' => $user->fonction ?? null,

                'recepteur_nom' => $validated['recepteur_nom'] ?? null,

                'recepteur_fonction' => $validated['recepteur_fonction'] ?? null,

                'total_quantite' => collect($validated['articles'])
                    ->sum('quantite'),
            ]);

            /*
             * On supprime les anciens articles
             * puis on enregistre les articles présents
             * dans le formulaire.
             */
            $bordereau->articles()->delete();

            foreach ($validated['articles'] as $article) {
                $bordereau->articles()->create([
                    'designation' => $article['designation'],
                    'quantite' => (int) $article['quantite'],
                    'observations' => $article['observations'] ?? null,
                ]);
            }
        });

        return redirect()
            ->route('bordereau.show', $bordereau)
            ->with('success', 'Bordereau mis à jour avec succès.');
    }

    /**
     * Suppression
     */
    public function destroy(Bordereau $bordereau)
    {
        $bordereau->delete();

        return redirect()
            ->route('bordereau.index')
            ->with('success', 'Bordereau supprimé.');
    }
}
