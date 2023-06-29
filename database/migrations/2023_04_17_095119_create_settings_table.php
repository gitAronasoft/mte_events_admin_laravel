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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('siteName')->nullable();
            $table->string('SiteSupportNumber')->nullable();
            $table->string('siteEmail')->nullable();
            $table->string('SiteCopyRight')->nullable();
            $table->string('siteLogo')->nullable();
            $table->string('siteFavicon')->nullable();
            $table->string('FacebookLink')->nullable();
            $table->string('TwitterLink')->nullable();
            $table->string('LinkedinLink')->nullable();
            $table->string('InstagramLink')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
