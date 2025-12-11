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
        Schema::create('affiliate_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_image')->nullable();
            $table->string('title');       
            $table->string('sub_title')->nullable();
            $table->string('slug')->unique();
            $table->string('affiliate_link');
            $table->text('description')->nullable();
            $table->string('banner')->nullable();
            $table->decimal('earnings', 10, 2)->default(0);
            $table->boolean('is_top_product')->default(false);
            $table->string('top_product_title')->nullable();
            $table->boolean('is_recommended')->default(false);
            $table->string('status')->default('active');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_products');
    }
};
