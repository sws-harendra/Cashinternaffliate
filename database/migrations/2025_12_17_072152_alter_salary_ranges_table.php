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
        Schema::table('salary_ranges', function (Blueprint $table) {
            $table->integer('min_salary')->nullable()->after('label');
            $table->integer('max_salary')->nullable()->after('min_salary');
            $table->boolean('is_active')->default(true)->after('max_salary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('salary_ranges', function (Blueprint $table) {
            $table->dropColumn(['min_salary', 'max_salary', 'is_active']);
        });
    }
};
