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
        Schema::create('events', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->index();
            $table->dateTime('date_of');
            $table->string('image')->nullable();
            $table->string('award')->nullable();
            $table->json('description')->nullable();
            $table->boolean('request_access')->default(false);
            $table->boolean('is_active')->default(false);
            $table->unsignedBigInteger('theme_id');
            $table->unsignedBigInteger('location_id');
            $table->timestamps();

            $table->foreign('theme_id')->references('id')->on('themes')->cascadeOnDelete()->restrictOnDelete();
            $table->foreign('location_id')->references('id')->on('locations')->cascadeOnDelete()->restrictOnDelete();
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
