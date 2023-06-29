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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eventService')->nullable();
            $table->string('title')->nullable();
            $table->longText('decription')->nullable();
            $table->string('eventLocation')->nullable();
            $table->string('eventDate')->nullable();
            $table->string('eventTime')->nullable();
            $table->bigInteger('eventTickets')->nullable();            
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
        Schema::dropIfExists('events');
    }
};
