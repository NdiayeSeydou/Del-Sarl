<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bordereau;
use Illuminate\Http\Request;

class BordereauController extends Controller
{
    private function buildNumero(string $prefix): string
    {
        $count = Bordereau::count() + 1;

        return $prefix.'-'.date('Y').'-'.str_pad((string) $count, 4, '0', STR_PAD_LEFT);
    }

    public function index(Request $request)
    {
        $query = Bordereau::with('articles');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('num_bl', 'like', "%{$search}%")
                    ->orWhere('client', 'like', "%{$search}%");
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('date_livraison', $request->date);
        }

        $bordereaux = $query->orderByDesc('date_livraison')->get();

        return view('admin.bordereau.index', compact('bordereaux'));
    }

    public function create()
    {
        return view('admin.bordereau.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client' => ['required', 'string', 'max:255'],
            'date_livraison' => ['required', 'date'],
            'reference' => ['nullable', 'string'],
            'emetteur_nom' => ['nullable', 'string'],
            'emetteur_fonction' => ['nullable', 'string'],
            'recepteur_nom' => ['nullable', 'string'],
            'recepteur_fonction' => ['nullable', 'string'],
            'articles' => ['required', 'array', 'min:1'],
            'articles.*.designation' => ['required', 'string'],
            'articles.*.quantite' => ['required', 'integer', 'min:1'],
            'articles.*.observations' => ['nullable', 'string'],
        ]);

        $bordereau = Bordereau::create([
            'client' => $validated['client'],
            'num_bl' => $validated['num_bl'] ?? $this->buildNumero('BL'),
            'date_livraison' => $validated['date_livraison'],
            'reference' => $validated['reference'] ?? null,
            'emetteur_nom' => $validated['emetteur_nom'] ?? null,
            'emetteur_fonction' => $validated['emetteur_fonction'] ?? null,
            'recepteur_nom' => $validated['recepteur_nom'] ?? null,
            'recepteur_fonction' => $validated['recepteur_fonction'] ?? null,
            'total_quantite' => collect($validated['articles'])->sum('quantite'),
        ]);

        foreach ($validated['articles'] as $article) {
            $bordereau->articles()->create([
                'designation' => $article['designation'],
                'quantite' => (int) $article['quantite'],
                'observations' => $article['observations'] ?? null,
            ]);
        }

        return redirect()->route('bordereau.show', $bordereau)->with('success', 'Bordereau enregistré.');
    }

    public function show(Bordereau $bordereau)
    {
        return view('admin.bordereau.show', compact('bordereau'));
    }

    public function edit(Bordereau $bordereau)
    {
        return view('admin.bordereau.edit', compact('bordereau'));
    }

    public function update(Request $request, Bordereau $bordereau)
    {
        $validated = $request->validate([
            'client' => ['required', 'string', 'max:255'],
            'date_livraison' => ['required', 'date'],
            'reference' => ['nullable', 'string'],
            'emetteur_nom' => ['nullable', 'string'],
            'emetteur_fonction' => ['nullable', 'string'],
            'recepteur_nom' => ['nullable', 'string'],
            'recepteur_fonction' => ['nullable', 'string'],
            'articles' => ['required', 'array', 'min:1'],
            'articles.*.designation' => ['required', 'string'],
            'articles.*.quantite' => ['required', 'integer', 'min:1'],
            'articles.*.observations' => ['nullable', 'string'],
        ]);

        $bordereau->update([
            'client' => $validated['client'],
            'date_livraison' => $validated['date_livraison'],
            'reference' => $validated['reference'] ?? null,
            'emetteur_nom' => $validated['emetteur_nom'] ?? null,
            'emetteur_fonction' => $validated['emetteur_fonction'] ?? null,
            'recepteur_nom' => $validated['recepteur_nom'] ?? null,
            'recepteur_fonction' => $validated['recepteur_fonction'] ?? null,
            'total_quantite' => collect($validated['articles'])->sum('quantite'),
        ]);

        $bordereau->articles()->delete();

        foreach ($validated['articles'] as $article) {
            $bordereau->articles()->create([
                'designation' => $article['designation'],
                'quantite' => (int) $article['quantite'],
                'observations' => $article['observations'] ?? null,
            ]);
        }

        return redirect()->route('bordereau.show', $bordereau)->with('success', 'Bordereau mis à jour.');
    }

    public function destroy(Bordereau $bordereau)
    {
        $bordereau->delete();

        return redirect()->route('bordereau.index')->with('success', 'Bordereau supprimé.');
    }
}
