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
    Schema::create('pending_checkouts', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->string('razorpay_order_id')
        ->unique();

    $table->string('razorpay_payment_id')
        ->nullable()
        ->unique();

    $table->decimal('expected_amount', 12, 2);

    $table->json('checkout_data');

    $table->string('status')
        ->default('pending');

    $table->timestamp('completed_at')
        ->nullable();

    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_checkouts');
    }
};
