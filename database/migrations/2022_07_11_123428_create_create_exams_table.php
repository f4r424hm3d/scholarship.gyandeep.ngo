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
        Schema::create('create_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scholarship_id');
            $table->foreign('scholarship_id')->references('id')->on('scholarships')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('course_category_id');
            $table->foreign('course_category_id')->references('id')->on('course_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('token', 100);
            $table->date('start_time');
            $table->date('end_time');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('create_exams');
    }
};
