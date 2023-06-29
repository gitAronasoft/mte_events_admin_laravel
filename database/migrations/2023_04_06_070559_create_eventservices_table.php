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
        Schema::create('eventservices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eventId')->nullable();
            $table->string('title')->nullable();
            $table->longText('decription')->nullable();
            $table->string('featureImage')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventservices');
    }
};
