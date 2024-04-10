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
            $table->dateTime('date_of');
            $table->string('image_url')->nullable();
            $table->string('award')->nullable();
            $table->text('description')->nullable();
            $table->boolean('request_access')->default(true);
            $table->boolean('is_active')->default(true);
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
