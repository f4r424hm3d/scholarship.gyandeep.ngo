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
    Schema::table('students', function (Blueprint $table) {
      $table->string('country_of_citizenship')->nullable();
      $table->string('parents_occupation')->nullable();
      $table->string('first_language')->nullable();
      $table->string('marital_status')->nullable();
      $table->string('religion')->nullable();
      $table->string('home_contact_number')->nullable();

      $table->year('passing_year_10')->nullable();
      $table->string('result_10')->nullable();
      $table->year('passing_year_12')->nullable();
      $table->string('result_12')->nullable();
      $table->year('neet_passing_year')->nullable();
      $table->string('neet_result')->nullable();

      $table->string('marksheet_10_path')->nullable();
      $table->string('marksheet_12_path')->nullable();
      $table->string('aadhar_path')->nullable();
      $table->string('photo_path')->nullable();
      $table->string('neet_result_path')->nullable();
      $table->string('passport_path')->nullable();

      $table->string('neet_status')->nullable();
      $table->boolean('submit_application')->default(false);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('students', function (Blueprint $table) {
      $table->dropColumn([
        'country_of_citizenship',
        'parents_occupation',
        'first_language',
        'marital_status',
        'religion',
        'home_contact_number',
        'passing_year_10',
        'result_10',
        'passing_year_12',
        'result_12',
        'neet_passing_year',
        'neet_result',
        'marksheet_10_path',
        'marksheet_12_path',
        'aadhar_path',
        'photo_path',
        'neet_result_path',
        'passport_path',
        'neet_status',
        'submit_application',
      ]);
    });
  }
};
