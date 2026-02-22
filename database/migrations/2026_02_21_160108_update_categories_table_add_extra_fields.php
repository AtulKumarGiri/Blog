<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {

            // Make slug unique
            $table->string('slug')->unique()->change();

            // Make existing fields nullable
            $table->mediumText('description')->nullable()->change();
            $table->string('image')->nullable()->change();
            $table->string('meta_title')->nullable()->change();
            $table->text('meta_description')->nullable()->change();
            $table->text('meta_keyword')->nullable()->change();

            // New fields
            $table->tinyInteger('is_featured')->default(0)->after('navbar_status');
            $table->integer('sort_order')->default(0)->after('is_featured');
            $table->string('canonical_url')->nullable()->after('sort_order');
            $table->unsignedBigInteger('parent_id')->nullable()->after('sort_order');
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {

            // Remove new fields
            $table->dropColumn(['is_featured', 'sort_order', 'canonical_url', 'parent_id']);

            // Remove unique from slug
            $table->dropUnique(['slug']);

            // Revert nullable changes (optional)
            $table->mediumText('description')->nullable(false)->change();
            $table->string('image')->nullable(false)->change();
            $table->string('meta_title')->nullable(false)->change();
            $table->text('meta_description')->nullable(false)->change();
            $table->text('meta_keyword')->nullable(false)->change();
        });
    }
};