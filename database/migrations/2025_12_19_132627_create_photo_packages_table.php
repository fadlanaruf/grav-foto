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
        Schema::create('photo_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('duration_minutes')->default(60);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed default packages
        DB::table('photo_packages')->insert([
            [
                'name' => 'Prewedding',
                'description' => 'Paket foto prewedding dengan berbagai konsep menarik',
                'price' => 2500000,
                'duration_minutes' => 120,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wedding',
                'description' => 'Paket foto pernikahan lengkap dengan dokumentasi acara',
                'price' => 5000000,
                'duration_minutes' => 480,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Model',
                'description' => 'Paket foto model untuk portfolio profesional',
                'price' => 1500000,
                'duration_minutes' => 90,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Keluarga',
                'description' => 'Paket foto keluarga dengan suasana hangat dan menyenangkan',
                'price' => 1000000,
                'duration_minutes' => 60,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wisuda',
                'description' => 'Paket foto wisuda untuk mengabadikan momen kelulusan',
                'price' => 500000,
                'duration_minutes' => 30,
                'is_active' => true,
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
        Schema::dropIfExists('photo_packages');
    }
};
