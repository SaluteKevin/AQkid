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
        Schema::create('user_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('originator_id');
            $table->unsignedBigInteger('course_id')->nullable()->comment('This is nullable since this is a generic user request table');
            $table->enum('type', ['REFUND', 'GENERAL']);
            $table->string('title');
            $table->string('description')->nullable();
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED', 'OTHER']);
            $table->string('review_comment')->nullable();
            $table->timestamps();

            $table->foreign('originator_id')->references('id')->on('users');
            $table->foreign('course_id')->references('id')->on('courses');
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
