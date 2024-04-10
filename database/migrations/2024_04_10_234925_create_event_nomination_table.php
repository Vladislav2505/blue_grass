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

        Schema::create('event_nomination', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('nomination_id');

            $table->unique(['event_id', 'nomination_id']);
            $table->foreign('event_id')->references('id')->on('events')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('nomination_id')->references('id')->on('nominations')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_nomination');
    }
};
