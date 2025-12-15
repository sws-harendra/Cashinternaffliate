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
        Schema::create('recruiter_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruiter_id')->constrained()->cascadeOnDelete();
            $table->string('logo')->nullable();
            $table->text('company_description');
            $table->string('industry');
            $table->string('company_size');
            $table->string('address');
            $table->string('website')->nullable();
            $table->string('hr_name');
            $table->string('hr_contact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruiter_profiles');
    }
};
