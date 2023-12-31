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
        Schema::create('checkout_products', function (Blueprint $table) {
            $table->id();

            // I'm always adding this field for e-commerce for counter checking and in case that the product price gets updated
            $table->decimal('price', 9, 2);
            $table->decimal('original_price', 9, 2);
            $table->integer('quantity');

            $table->foreignId('checkout_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout_products');
    }
};
