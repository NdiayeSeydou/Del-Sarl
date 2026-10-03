<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => config('admin.email')],
            [
                'name' => 'Ndiaye Seydou',
                'fonction' => 'Administrateur',
                'password' => config('admin.password'),
                'email_verified_at' => now(),
            ],
        );
    }
}
