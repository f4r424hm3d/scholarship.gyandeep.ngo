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
    Schema::table('student_exam_offer_latters', function (Blueprint $table) {
      $table->string('sent_to')->nullable()->after('mail_body');
      $table->string('cc_email')->nullable()->after('mail_body');
      $table->unsignedBigInteger('send_by')->nullable()->after('cc_email');
      $table->foreign('send_by')->references('id')->on('users')->onDelete('set null');
      $table->string('token')->nullable()->after('send_by');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('student_exam_offer_latters', function (Blueprint $table) {
      $table->dropForeign(['send_by']);
      $table->dropColumn(['cc_email', 'send_by', 'sent_to', 'token']);
    });
  }
};
