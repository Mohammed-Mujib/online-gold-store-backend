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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Basic info
            $table->string('name');
            // $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();

            // Gold-specific attributes
            $table->decimal('weight', 8, 2); // grams
            $table->unsignedTinyInteger('karat'); // e.g., 24, 22, 21, 18
            $table->string('type')->nullable(); // ring, chain, bracelet, etc.

            // Pricing
            $table->decimal('gold_price_per_gram', 10, 2)->default(0);
            $table->decimal('making_fee', 10, 2)->default(0);
            $table->decimal('total_price', 12, 2);

            // Stock & SKU
            // $table->string('sku')->unique();
            $table->integer('stock')->default(0);

            // Category relation (optional)
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();

            // Images (store paths or JSON array)
            $table->json('images')->nullable();

            // Status
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
