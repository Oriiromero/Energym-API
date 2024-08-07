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
        Schema::create('activities', function(Blueprint $table)
        {
            $table->id();
            $table->unsignedBigInteger('tainer_id')->nullable();
            $table->string('name');
            $table->date('description');
            $table->date('schedule');
            $table->string('capacity');

            $table->foreign('trainer_id')->references('id')->on('trainers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
