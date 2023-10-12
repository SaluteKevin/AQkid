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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->string('title', 128);
            $table->integer('quota');
            $table->integer('capacity');
            $table->integer('min_age')->default(0);
            $table->integer('max_age');
            $table->integer('duration')->default(60);
            $table->datetime('opens_until');
            $table->datetime('start_datetime');
            $table->enum('status', ['PENDING', 'OPEN', 'FULL', 'ACTIVE', 'ENDED', 'CANCELLED']);
            $table->float('price');
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
