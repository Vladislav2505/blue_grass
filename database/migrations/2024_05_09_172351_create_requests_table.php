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
        Schema::create('requests', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('status');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->date('date_of_birth');
            $table->string('address');
            $table->string('team_name')->nullable();
            $table->string('supervisor_full_name');
            $table->string('organization_name');
            $table->date('date_creation_team')->nullable();
            $table->integer('participants_number')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
