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
    Schema::create('student_scholarship_letters', function (Blueprint $table) {
      $table->id();
      $table->string('letter_to')->nullable();
      $table->longText('letter_description');
      $table->unsignedBigInteger('company_id')->nullable();
      $table->foreign('company_id')->references('id')->on('company_profiles');
      $table->unsignedBigInteger('student_id')->nullable();
      $table->foreign('student_id')->references('id')->on('students');
      $table->unsignedBigInteger('created_by')->nullable();
      $table->foreign('created_by')->references('id')->on('users');
      $table->boolean('stamped')->default(0);
      $table->boolean('signature')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('student_scholarship_letters');
  }
};
