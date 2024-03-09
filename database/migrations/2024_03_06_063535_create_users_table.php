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
        // Create users table only if one is not already created
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('user_email')->unique()->required();
                $table->string('first_name')->required();
                $table->string('last_name')->required();
                // created_at, updated_at columns for audit purposes
                $table->timestamps();
            });
        } else {
            throw new PDOException("Users table already exists");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop users table if exists
        Schema::dropIfExists('users');
    }
};
