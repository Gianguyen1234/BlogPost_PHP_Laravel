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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->unique()->after('content'); // Add slug column
            $table->text('youtube_iframe')->nullable()->after('slug'); // Add youtube_iframe column
            $table->string('meta_title')->nullable()->after('youtube_iframe'); // Add meta title column
            $table->text('meta_description')->nullable()->after('meta_title'); // Add meta description column
            $table->text('meta_keyword')->nullable()->after('meta_description'); // Add meta keyword column
            $table->tinyInteger('status')->default(0)->after('meta_keyword'); // Add status column
            $table->unsignedBigInteger('created_by')->nullable()->after('status'); // Add created_by column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['slug', 'youtube_iframe', 'meta_title', 'meta_description', 'meta_keyword', 'status', 'created_by']);
        });
    }
};
