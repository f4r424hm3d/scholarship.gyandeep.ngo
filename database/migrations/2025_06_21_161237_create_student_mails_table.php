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
    Schema::create('student_mails', function (Blueprint $table) {
      $table->id();
      $table->string('sent_to')->nullable();
      $table->string('cc')->nullable();
      $table->unsignedBigInteger('student_id');
      $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
      $table->unsignedBigInteger('sender');
      $table->foreign('sender')->references('id')->on('users')->onDelete('cascade');
      $table->string('subject');
      $table->longText('message');
      $table->text('token');
      $table->boolean('is_read')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('student_mails');
  }
};
