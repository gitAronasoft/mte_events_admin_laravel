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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); 
            $table->string('slug')->nullable(); 
            $table->bigInteger('emp_code')->nullable(); 
            $table->string('email')->unique()->nullable(); 
            $table->longText('mobile')->unique()->nullable(); 
            $table->longText('address')->nullable(); 
            $table->longText('designation')->nullable(); 
            $table->string('gender')->nullable(); 
            $table->longText('image')->nullable(); 
            $table->string('status')->nullable();
            $table->longText('facebook_url')->nullable();
            $table->longText('twitter_url')->nullable();
            $table->longText('linkedin_url')->nullable(); 
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
