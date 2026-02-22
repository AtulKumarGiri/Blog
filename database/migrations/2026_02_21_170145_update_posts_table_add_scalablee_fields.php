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

            // Make slug unique
            $table->string('slug')->unique()->change();

            // Add image column
            $table->string('image')->nullable()->after('description');

            // Add canonical URL
            $table->string('canonical_url')->nullable()->after('meta_keyword');

            // Add publishing system
            $table->string('status')->default('draft')->change();

            $table->timestamp('published_at')->nullable()->after('status');

            // Featured post option
            $table->boolean('is_featured')->default(false)->after('published_at');

            // Views counter
            $table->unsignedBigInteger('views')->default(0)->after('is_featured');

            // Soft Deletes
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {

            $table->dropColumn([
                'image',
                'canonical_url',
                'published_at',
                'is_featured',
                'views',
                'deleted_at'
            ]);
        });
    }
};