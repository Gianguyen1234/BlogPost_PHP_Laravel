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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Reference to the users table
            $table->text('bio')->nullable(); // User's bio
            $table->string('profile_picture')->nullable(); // Profile picture URL
            $table->string('github_link')->nullable(); // GitHub profile link
            $table->string('twitter_link')->nullable(); // Twitter profile link
            $table->string('linkedin_link')->nullable(); // LinkedIn profile link
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
