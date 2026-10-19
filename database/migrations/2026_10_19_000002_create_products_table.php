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
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('badge')->nullable(); // e.g. "-52%", "Terjual Habis", "Hot", "Best Seller"
            $table->string('concentration')->default('Extrait de Parfum'); // Extrait de Parfum, EDP
            $table->enum('gender', ['men', 'women', 'unisex'])->default('unisex');
            $table->string('scent_family')->nullable(); // Gourmand, Fresh, Woody, Floral, Oriental
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            
            // Fragrance notes
            $table->string('top_notes')->nullable();
            $table->string('middle_notes')->nullable();
            $table->string('base_notes')->nullable();
            
            // Performance
            $table->string('longevity')->default('12 - 14 Jam');
            $table->string('sillage')->default('Kuat / Strong');
            $table->string('projection')->default('2 Meter');
            $table->string('mood')->nullable();
            
            // Pricing & Inventory
            $table->decimal('price', 12, 2);
            $table->decimal('original_price', 12, 2)->nullable();
            $table->integer('discount_percent')->nullable();
            $table->integer('stock')->default(50);
            $table->boolean('is_sold_out')->default(false);
            
            // Social proof
            $table->decimal('rating', 3, 1)->default(4.9);
            $table->integer('reviews_count')->default(120);
            
            // Media
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            
            // Flags
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_bestseller')->default(false);
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
