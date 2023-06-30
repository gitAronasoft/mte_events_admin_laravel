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
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('title')->unique()->after('id')->nullable();
            $table->string('albumSlug')->after('title')->nullable();
            $table->string('featureImage')->after('upload_video')->nullable();
            $table->string('portfoliosDate')->after('featureImage')->nullable();
            $table->string('status')->after('portfoliosDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('albumSlug');
            $table->dropColumn('featureImage');
            $table->dropColumn('portfoliosDate');
            $table->dropColumn('status');
        });
    }
};
