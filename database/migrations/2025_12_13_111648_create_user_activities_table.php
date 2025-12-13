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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();

            $table->string('user_id'); // users.uuid
            $table->string('activity_type'); // app_open, login, logout, page_view
            $table->string('screen')->nullable(); // home, wallet, profile
            $table->string('device_type')->nullable(); // android, ios, web
            $table->string('device_id')->nullable();
            $table->string('app_version')->nullable();

            $table->string('ip')->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};
