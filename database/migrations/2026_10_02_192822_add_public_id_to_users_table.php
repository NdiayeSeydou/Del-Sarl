<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $publicIdColumnExists = Schema::hasColumn('users', 'public_id');

        if (! $publicIdColumnExists) {
            Schema::table('users', function (Blueprint $table): void {
                $table->string('public_id')->nullable();
            });
        }

        DB::table('users')
            ->whereNull('public_id')
            ->orderBy('id')
            ->chunkById(200, function (Collection $users): void {
                foreach ($users as $user) {
                    do {
                        $publicId = 'usr_'.Str::lower(Str::random(10));
                    } while (DB::table('users')->where('public_id', $publicId)->exists());

                    DB::table('users')
                        ->where('id', $user->id)
                        ->update(['public_id' => $publicId]);
                }
            });

        if (! $publicIdColumnExists) {
            Schema::table('users', function (Blueprint $table): void {
                $table->string('public_id')->nullable(false)->change();
                $table->unique('public_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Public IDs are retained because they may have existed before this compatibility migration.
    }
};
