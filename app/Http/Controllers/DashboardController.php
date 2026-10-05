<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Proforma;
use App\Models\Bordereau;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $maintenant = Carbon::now();

        /*
        |--------------------------------------------------------------------------
        | Chiffre des factures du mois en cours
        |--------------------------------------------------------------------------
        */

        $montantFacturesMois = Facture::whereMonth('date_facture', $maintenant->month)
            ->whereYear('date_facture', $maintenant->year)
            ->sum('grand_total');


        /*
        |--------------------------------------------------------------------------
        | Totaux généraux
        |--------------------------------------------------------------------------
        */

        $totalFactures = Facture::count();

        $totalProformas = Proforma::count();

        $totalBordereaux = Bordereau::count();


        /*
        |--------------------------------------------------------------------------
        | Les 5 derniers documents
        |--------------------------------------------------------------------------
        */

        $documents = Facture::latest('created_at')
            ->take(5)
            ->get()
            ->map(fn (Facture $facture): array => [
                'reference' => $facture->num_facture,
                'client' => $facture->client,
                'montant' => $facture->grand_total,
                'unite' => 'F',
                'date' => $facture->date_facture,
                'type' => 'Facture',
                'route' => route('facture.show', $facture),
                'created_at' => $facture->created_at,
            ]);

        $documents = $documents->concat(Proforma::latest('created_at')
            ->take(5)
            ->get()
            ->map(fn (Proforma $proforma): array => [
                'reference' => $proforma->num_proforma,
                'client' => $proforma->client,
                'montant' => $proforma->grand_total,
                'unite' => $proforma->devise,
                'date' => $proforma->date_proforma,
                'type' => 'Pro Forma',
                'route' => route('proforma.show', $proforma),
                'created_at' => $proforma->created_at,
            ]));

        $documents = $documents->concat(Bordereau::latest('created_at')
            ->take(5)
            ->get()
            ->map(fn (Bordereau $bordereau): array => [
                'reference' => $bordereau->num_bl,
                'client' => $bordereau->client,
                'montant' => null,
                'unite' => null,
                'date' => $bordereau->date_livraison,
                'type' => 'Bordereau',
                'route' => route('bordereau.show', $bordereau),
                'created_at' => $bordereau->created_at,
            ]))
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