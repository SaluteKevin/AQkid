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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('originator_id');
            $table->enum('type', ['REFUND', 'GENERAL']);
            $table->string('title');
            $table->string('description')->nullable();
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED', 'OTHER']);
            $table->string('comments')->nullable();
            $table->timestamps();

            $table->foreign('originator_id')->references('id')->on('users');
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
