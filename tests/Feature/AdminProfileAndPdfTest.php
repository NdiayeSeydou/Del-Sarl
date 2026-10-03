<?php

namespace Tests\Feature;

use App\Models\Bordereau;
use App\Models\Facture;
use App\Models\Proforma;
use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AdminProfileAndPdfTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_user_seeder_creates_the_configured_login(): void
    {
        config([
            'admin.email' => 'ndiaye@gmail.com',
            'admin.password' => 'ndiaye123',
        ]);

        $this->seed(AdminUserSeeder::class);

        $user = User::where('email', 'ndiaye@gmail.com')->firstOrFail();

        $this->assertSame('Ndiaye Seydou', $user->name);
        $this->assertTrue(Hash::check('ndiaye123', $user->getAuthPassword()));

        $this->post(route('login'), [
            'email' => 'ndiaye@gmail.com',
            'password' => 'ndiaye123',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_guest_is_redirected_from_the_dashboard(): void
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
    }

    public function test_auth_migration_handles_existing_users_without_fonction_column(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn('fonction');
        });

        DB::table('users')->insert([
            'public_id' => 'usr_legacyuser',
            'name' => null,
            'email' => 'legacy@example.com',
            'password' => Hash::make('legacy-password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $migration = require database_path('migrations/2026_10_02_182209_add_authentication_fields_to_users_table.php');
        $migration->up();

        $this->assertTrue(Schema::hasColumn('users', 'fonction'));
        $this->assertDatabaseHas('users', [
            'email' => 'legacy@example.com',
            'name' => 'legacy@example.com',
        ]);
    }

    public function test_public_id_migration_backfills_existing_users_when_column_is_missing(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropUnique('users_public_id_unique');
            $table->dropColumn('public_id');
        });

        DB::table('users')->insert([
            'name' => 'Legacy User',
            'fonction' => 'Comptable',
            'email' => 'legacy-public-id@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('legacy-password'),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $migration = require database_path('migrations/2026_10_02_192822_add_public_id_to_users_table.php');
        $migration->up();

        $user = DB::table('users')->where('email', 'legacy-public-id@example.com')->first();

        $this->assertTrue(Schema::hasColumn('users', 'public_id'));
        $this->assertMatchesRegularExpression('/^usr_[a-z0-9]{10}$/', $user->public_id);

        config([
            'admin.email' => 'seeded-admin@example.com',
            'admin.password' => 'secure-password',
        ]);
        $this->seed(AdminUserSeeder::class);

        $admin = User::where('email', 'seeded-admin@example.com')->firstOrFail();
        $this->assertMatchesRegularExpression('/^usr_[a-z0-9]{10}$/', $admin->public_id);
    }

    public function test_pdf_routes_download_each_document_template(): void
    {
        $user = User::factory()->create();
        $facture = Facture::create([
            'client' => 'Client PDF Facture',
            'num_facture' => 'FAC-PDF-001',
            'date_facture' => '2026-10-02',
            'statut_paiement' => 'unpaid',
            'subtotal_ht' => 12500,
            'grand_total' => 12500,
        ]);
        $facture->articles()->create([
            'designation' => 'Article facture PDF',
            'quantite' => 1,
            'prix_unitaire' => 12500,
            'prix_total' => 12500,
        ]);

        $proforma = Proforma::create([
            'client' => 'Client PDF Proforma',
            'num_proforma' => 'PRO-PDF-001',
            'date_proforma' => '2026-10-02',
            'devise' => 'XOF',
            'subtotal_ht' => 15000,
            'grand_total' => 15000,
        ]);
        $proforma->articles()->create([
            'designation' => 'Article proforma PDF',
            'quantite' => 1,
            'prix_unitaire' => 15000,
            'prix_total' => 15000,
        ]);

        $bordereau = Bordereau::create([
            'client' => 'Client PDF Bordereau',
            'num_bl' => 'BL-PDF-001',
            'date_livraison' => '2026-10-02',
            'total_quantite' => 1,
        ]);
        $bordereau->articles()->create([
            'designation' => 'Article bordereau PDF',
            'quantite' => 1,
        ]);

        $this->assertStringContainsString(
            'Client PDF Facture',
            view('admin.pdf.facture', ['facture' => $facture->load('articles')])->render(),
        );
        $this->assertStringContainsString(
            'Article proforma PDF',
            view('admin.pdf.proforma', ['proforma' => $proforma->load('articles')])->render(),
        );
        $this->assertStringContainsString(
            'Article bordereau PDF',
            view('admin.pdf.bordereau', ['bordereau' => $bordereau->load('articles')])->render(),
        );

        $this->actingAs($user);

        foreach ([
            route('facture.pdf', $facture),
            route('proforma.pdf', $proforma),
            route('bordereau.pdf', $bordereau),
        ] as $url) {
            $response = $this->get($url);

            $response->assertOk()->assertHeader('content-type', 'application/pdf');
            $this->assertStringStartsWith('%PDF-', $response->getContent());
        }
    }

    public function test_user_can_manage_profile_information_on_dasher_profile_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('profil.utilisateur'))
            ->assertOk()
            ->assertSee('value="'.$user->name.'"', false)
            ->assertSee('value="'.$user->email.'"', false);

        $this->patch(route('profile.update'), [
            'name' => 'Ndiaye Updated',
            'email' => $user->email,
            'fonction' => 'Responsable',
        ])->assertRedirect(route('profile.edit'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Ndiaye Updated',
            'fonction' => 'Responsable',
        ]);
    }
}
