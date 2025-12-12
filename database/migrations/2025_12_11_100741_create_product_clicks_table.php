<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_clicks', function (Blueprint $table) {
            $table->id();
            $table->string('lead_id')->unique(); 
            $table->unsignedBigInteger('affiliate_product_id');
            $table->string('user_id')->nullable(); // who shared
            $table->string('click_id')->unique(); // internal tracking id (Offer18 will receive this)
            $table->string('sub_aff_id')->nullable(); // optional, store user identifier sent to affiliate
            $table->string('ip')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('referrer')->nullable();
            $table->integer('status')->default(0);  // 0 = pending , 1 = progress , 3 = completed, 4 = expired
            $table->boolean('is_converted')->default(false);
            $table->timestamp('clicked_at')->nullable();
            $table->timestamp('converted_at')->nullable();
            $table->timestamps();

            $table->foreign('affiliate_product_id')
                ->references('id')->on('affiliate_products')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_clicks');
    }
};
