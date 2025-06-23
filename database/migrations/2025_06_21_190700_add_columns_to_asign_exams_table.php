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
    Schema::table('asign_exams', function (Blueprint $table) {
      $table->string('scholarship_percentage', 100)->nullable()->after('submitted');
      $table->string('scholarship_amount', 100)->nullable()->after('scholarship_percentage');
      $table->string('total_tution_fee', 100)->nullable()->after('scholarship_amount');
      $table->string('fee_after_scholarship', 100)->nullable()->after('total_tution_fee');
      $table->string('eligibility_category', 100)->nullable()->after('fee_after_scholarship');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('asign_exams', function (Blueprint $table) {
      $table->dropColumn('scholarship_percentage');
      $table->dropColumn('scholarship_amount');
      $table->dropColumn('total_tution_fee');
      $table->dropColumn('fee_after_scholarship');
      $table->dropColumn('eligibility_category');
    });
  }
};
