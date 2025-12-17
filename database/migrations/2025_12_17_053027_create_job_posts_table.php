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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('recruiter_id')->constrained()->cascadeOnDelete();

            $table->foreignId('job_category_id')->constrained();
            $table->foreignId('job_role_id')->constrained();
            $table->foreignId('job_type_id')->constrained();
            $table->foreignId('job_location_id')->constrained();

            $table->foreignId('experience_level_id')->constrained();
            $table->foreignId('salary_range_id')->nullable()->constrained();

            $table->string('title');
            $table->string('slug')->unique();

            $table->longText('description');
            $table->longText('responsibilities')->nullable();
            $table->string('skills')->nullable();

            $table->enum('status', [
                'draft',
                'pending',
                'approved',
                'rejected'
            ])->default('draft');

            $table->boolean('is_active')->default(true);

            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('admins');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
