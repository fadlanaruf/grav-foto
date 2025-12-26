<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Set a new lowest order for 'Menunggu Persetujuan'
        DB::table('reservation_statuses')->insert([
            [
                'name' => 'Menunggu Persetujuan',
                'order' => 0,
                'color' => 'orange',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('reservation_statuses')->where('name', 'Menunggu Persetujuan')->delete();
    }
};
