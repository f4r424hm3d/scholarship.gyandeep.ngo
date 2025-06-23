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
    Schema::create('student_exam_offer_latters', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('exam_id');
      $table->foreign('exam_id')->references('id')->on('asign_exams')->onDelete('cascade');
      $table->text('letter_path')->nullable();
      $table->longText('mail_body')->nullable();
      $table->boolean('is_sent')->default(false);
      $table->boolean('is_viewed')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('student_exam_offer_latters');
  }
};
