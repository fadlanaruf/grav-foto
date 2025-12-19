<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservation_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('order')->default(0);
            $table->string('color')->default('gray');
            $table->timestamps();
        });

        // Seed default statuses
        DB::table('reservation_statuses')->insert([
            [
                'name' => 'Menunggu Difoto',
                'order' => 1,
                'color' => 'blue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Proses Editing',
                'order' => 2,
                'color' => 'yellow',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dicetak',
                'order' => 3,
                'color' => 'purple',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Selesai',
                'order' => 4,
                'color' => 'green',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_statuses');
    }
};
