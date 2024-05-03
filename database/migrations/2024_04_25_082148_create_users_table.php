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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 100);
            $table->string('username', length: 100)->unique('idx_users_unsername_unique');
            $table->string('email', length: 100)->unique('idx_users_email_unique');
            $table->string('password');
            $table->text('bio')->nullable();
            $table->string('avatar')->default('images/avatar/avatar.jpeg');
            $table->string('google_id')->nullable();
            $table->string('google_token')->nullable();
            $table->string('google_refresh_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
