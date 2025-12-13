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
        Schema::create('user_payment_methods', function (Blueprint $table) {
            $table->id();

            $table->string('user_id'); // users.uuid
            $table->enum('type', ['upi', 'bank']);

            // Common
            $table->string('holder_name')->nullable();

            // UPI fields
            $table->string('upi_id')->nullable();

            // Bank fields
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('branch')->nullable();

            // Verification (IMPORTANT)
            $table->enum('verification_status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->string('rejection_reason')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('verified_by')->nullable(); // admin uuid

            // UX
            $table->boolean('is_default')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_payment_methods');
    }
};
