<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_code')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('photo_package_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('address');
            $table->string('phone');
            $table->integer('number_of_people')->default(1);
            $table->date('photo_date');
            $table->time('photo_time');
            $table->foreignId('reservation_status_id')->constrained()->onDelete('cascade');
            $table->enum('payment_status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->decimal('payment_amount', 10, 2);
            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
