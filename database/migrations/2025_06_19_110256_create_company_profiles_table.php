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
    Schema::create('company_profiles', function (Blueprint $table) {
      $table->id();
      $table->string('company_name');
      $table->string('email')->nullable();
      $table->string('mobile')->nullable();
      $table->string('gst')->nullable();
      $table->string('website_address')->nullable();
      $table->string('address')->nullable();
      $table->string('logo_path')->nullable();
      $table->string('barcode_path')->nullable();
      $table->string('stamp_path')->nullable();
      $table->string('signature_path')->nullable();
      $table->boolean('show_to_counsellor')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('company_profiles');
  }
};
