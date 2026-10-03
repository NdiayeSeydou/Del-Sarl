<?php

namespace Tests\Feature;

use App\Models\Bordereau;
use App\Models\Facture;
use App\Models\Proforma;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DocumentCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_document_crud_routes_display_data_from_database(): void
    {
        $facture = Facture::create([
            'client' => 'Client Facture Test',
            'num_facture' => 'FAC-2026-001',
            'date_facture' => '2026-10-02',
            'statut_paiement' => 'unpaid',
            'subtotal_ht' => 150000,
            'montant_tva' => 27000,
            'grand_total' => 177000,
        ]);
        $facture->articles()->create([
            'designation' => 'Service de maintenance',
            'quantite' => 2,
            'prix_unitaire' => 75000,
            'prix_total' => 150000,
        ]);

        $proforma = Proforma::create([
            'client' => 'Client Proforma Test',
            'num_proforma' => 'PRO-2026-001',
            'date_proforma' => '2026-10-02',
            'subtotal_ht' => 200000,
            'montant_tva' => 36000,
            'grand_total' => 236000,
        ]);
        $proforma->articles()->create([
            'designation' => 'Matériel informatique',
            'quantite' => 1,
            'prix_unitaire' => 200000,
            'prix_total' => 200000,
        ]);

        $bordereau = Bordereau::create([
            'client' => 'Client Bordereau Test',
            'num_bl' => 'BL-2026-001',
            'date_livraison' => '2026-10-02',
            'reference' => 'Référence test',
            'emetteur_nom' => 'Doucouré Aïssata',
            'emetteur_fonction' => 'Gérante',
            'recepteur_nom' => 'Youba Maïga',
            'recepteur_fonction' => 'Agent',
            'total_quantite' => 3,
        ]);
        $bordereau->articles()->create([
            'designation' => 'Ordinateur portable',
            'quantite' => 3,
            'observations' => 'Livraison complète',
        ]);

        $this->actingAs(User::factory()->create());

        $this->get(route('facture.index'))->assertOk()->assertSeeText('Client Facture Test');
        $this->get(route('facture.show', $facture))->assertOk()->assertSeeText('Service de maintenance');

        $this->get(route('proforma.index'))->assertOk()->assertSeeText('Client Proforma Test');
        $this->get(route('proforma.show', $proforma))->assertOk()->assertSeeText('Matériel informatique');

        $this->get(route('bordereau.index'))->assertOk()->assertSeeText('Client Bordereau Test');
        $this->get(route('bordereau.show', $bordereau))->assertOk()->assertSeeText('Ordinateur portable');
    }
}
