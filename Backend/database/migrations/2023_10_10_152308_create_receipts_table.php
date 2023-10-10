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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enrollment_id');
            $table->timestamp('payment_timestamp');
            $table->timestamp('receipt_timestamp');
            $table->string('description');
            $table->float('amount');
            $table->float('subtotal');
            $table->float('total');
            $table->timestamps();

            $table->foreign('enrollment_id')->references('id')->on('enrollments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
