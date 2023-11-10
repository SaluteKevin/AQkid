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
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('timeslot_id');
            $table->unsignedBigInteger('student_id');
            $table->enum('has_attended', ['TRUE', 'FALSE'])->default('FALSE');
            $table->unsignedBigInteger('course_joint_id')->nullable();
            $table->string('review_comment',500)->nullable();

            $table->foreign('timeslot_id')->references('id')->on('timeslots');
            $table->foreign('student_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attendances');
    }
};
