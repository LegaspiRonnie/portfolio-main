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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('image_url')->nullable()->after('description');
            $table->string('demo_url')->nullable()->after('image_url');
            $table->string('repo_url')->nullable()->after('demo_url');
            $table->decimal('rating', 2, 1)->nullable()->after('repo_url');
            $table->boolean('featured')->default(false)->after('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['image_url', 'demo_url', 'repo_url', 'rating', 'featured']);
        });
    }
};
