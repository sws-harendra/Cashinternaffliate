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
        Schema::create('withdraw_requests', function (Blueprint $table) {
            $table->id();
            $table->string('user_id'); // users.uuid
            $table->unsignedBigInteger('wallet_id');

            $table->unsignedBigInteger('payment_method_id');

            $table->decimal('amount', 10, 2);

            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->string('rejection_reason')->nullable();

            $table->timestamp('processed_at')->nullable();
            $table->string('processed_by')->nullable(); // admin uuid

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraw_requests');
    }
};
