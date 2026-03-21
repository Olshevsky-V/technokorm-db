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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('header')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('header-color')->nullable();
            $table->string('text-color')->nullable();
            $table->string('background-color')->nullable();
            $table->string('link');
            $table->boolean('is-active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
