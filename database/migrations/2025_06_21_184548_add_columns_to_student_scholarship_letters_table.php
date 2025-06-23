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
    Schema::table('student_scholarship_letters', function (Blueprint $table) {
      $table->unsignedBigInteger('exam_id')->nullable()->after('signature');
      $table->foreign('exam_id')->references('id')->on('create_exams')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('student_scholarship_letters', function (Blueprint $table) {
      $table->dropForeign(['exam_id']);
      $table->dropColumn('exam_id');
    });
  }
};
