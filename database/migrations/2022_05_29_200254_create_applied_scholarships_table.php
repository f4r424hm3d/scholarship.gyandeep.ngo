<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applied_scholarships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('std_id');
            $table->foreign('std_id')->references('id')->on('students');
            $table->unsignedBigInteger('scholarship_id');
            $table->foreign('scholarship_id')->references('id')->on('scholarships');
            $table->boolean('status')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applied_scholarships');
    }
};
