<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Proforma;
use App\Models\Bordereau;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $maintenant = Carbon::now();

        // Montant total des factures du mois en cours
        $montantFacturesMois = Facture::whereMonth('date_facture', $maintenant->month)
            ->whereYear('date_facture', $maintenant->year)
            ->sum('grand_total');

        // Totaux
        $totalFactures = Facture::count();
        $totalProformas = Proforma::count();
        $totalBordereaux = Bordereau::count();

        /*
        |--------------------------------------------------------------------------
        | 5 derniers documents générés
        |--------------------------------------------------------------------------
        */

        $documents = collect();

        // Dernières factures
        $factures = Facture::latest('created_at')
            ->take(5)
            ->get();

        foreach ($factures as $facture) {
            $documents->push([
                'type' => 'Facture',
                'reference' => $facture->num_facture,
                'client' => $facture->client,
                'montant' => $facture->grand_total,
                'unite' => 'FCFA',
                'date' => $facture->date_facture,
                'created_at' => $facture->created_at,
                'route' => route('facture.show', $facture),
            ]);
        }

        // Dernières proformas
        $proformas = Proforma::latest('created_at')
            ->take(5)
            ->get();

        foreach ($proformas as $proforma) {
            $documents->push([
                'type' => 'Pro Forma',
                'reference' => $proforma->num_proforma,
                'client' => $proforma->client,
                'montant' => $proforma->grand_total,
                'unite' => $proforma->devise === 'XOF'
                    ? 'FCFA'
                    : $proforma->devise,
                'date' => $proforma->date_proforma,
                'created_at' => $proforma->created_at,
                'route' => route('proforma.show', $proforma),
            ]);
        }

        // Derniers bordereaux
        $bordereaux = Bordereau::with('proforma')
            ->latest('created_at')
            ->take(5)
            ->get();

        foreach ($bordereaux as $bordereau) {
            $documents->push([
                'type' => 'Bordereau',
                'reference' => $bordereau->num_bl,
                'client' => $bordereau->proforma?->client ?? '—',
                'montant' => null,
                'unite' => null,
                'date' => $bordereau->date_livraison,
                'created_at' => $bordereau->created_at,
                'route' => route('bordereau.show', $bordereau),
            ]);
        }

        // Mélanger les 3 catégories et récupérer les 5 derniers
        $documents = $documents
            ->sortByDesc('created_at')
            ->take(5)
            ->values();

        return view('dashboard', compact(
            'montantFacturesMois',
            'totalFactures',
            'totalProformas',
            'totalBordereaux',
            'documents'
        ));
    }
}