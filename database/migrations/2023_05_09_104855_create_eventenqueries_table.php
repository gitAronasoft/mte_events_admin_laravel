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
        Schema::create('eventenqueries', function (Blueprint $table) {
            $table->id();
            $table->string('event')->nullable();
            $table->string('fullName')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            $table->string('dateevent')->nullable();
            $table->string('location')->nullable();
            $table->string('venue')->nullable();
            $table->string('guestCount')->nullable();
            $table->string('eBudget')->nullable();
            $table->longText('knowAbout')->nullable();
            $table->string('otherInfo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventenqueries');
    }
};

