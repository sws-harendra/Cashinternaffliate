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
        Schema::create('products_earning_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('affiliate_product_id');
            $table->string('level_name');
            $table->string('level_description');
            $table->decimal('amount', 10, 2);
            $table->timestamps();
            $table->foreign('affiliate_product_id')->references('id')->on('affiliate_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_earning_levels');
    }
};
