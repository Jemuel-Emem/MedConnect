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
        Schema::create('refferreds', function (Blueprint $table) {
            $table->id();
               $table->unsignedBigInteger('patient_id');
    $table->unsignedBigInteger('med_id');

    // Doctor name (from users table, based on med_id)
    $table->string('mdname');

    // Referral info
    $table->date('date_referred');
    $table->time('time_referred');

    // Patient info
    $table->integer('age');
    $table->string('sex', 10);
    $table->string('religion')->nullable();

    // Medical details
    $table->string('status')->nullable(); // e.g., stable/critical
    $table->text('diagnosis_impression')->nullable();
    $table->text('other_diagnos')->nullable();
    $table->text('reason_for_referral')->nullable();
    $table->text('remarks')->nullable();
            $table->timestamps();

              $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
    $table->foreign('med_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refferreds');
    }
};
