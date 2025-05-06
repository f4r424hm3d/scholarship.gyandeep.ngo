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
        Schema::create('asign_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->unsignedBigInteger('exam_id');
            $table->foreign('exam_id')->references('id')->on('create_exams');
            $table->integer('max_marks')->nullable();
            $table->integer('obtain_marks')->nullable();
            $table->string('result')->nullable();
            $table->boolean('attended')->default(0);
            $table->dateTime('attended_at')->nullable();
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
        Schema::dropIfExists('asign_exams');
    }
};
