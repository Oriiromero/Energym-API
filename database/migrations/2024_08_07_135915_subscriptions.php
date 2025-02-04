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
        Schema::create('subscriptions', function(Blueprint $table)
        {
            $table->id();
            $table->unsignedBigInteger('member_id')->nullable();
            $table->string('sub_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status');

            $table->foreign('member_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
