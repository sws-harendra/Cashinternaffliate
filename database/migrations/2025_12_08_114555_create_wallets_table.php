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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();           
            $table->string('user_id');
            $table->string('uuid')->unique();
            $table->decimal('collection', 10, 2)->default(0);
            $table->decimal('balance', 10, 2)->default(0);
            $table->decimal('hold_balance', 10, 2)->default(0);
            $table->decimal('total_withdraw', 10, 2)->default(0);
            $table->decimal('refer_balance', 10, 2)->default(0);

            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
