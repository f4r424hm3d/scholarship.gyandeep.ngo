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
        Schema::create('answer_sheets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->unsignedBigInteger('exam_id');
            $table->foreign('exam_id')->references('id')->on('create_exams');
            $table->integer('subject_id')->nullable();
            $table->integer('question_id');
            $table->string('answer_option', 100)->nullable();
            $table->string('answer', 100)->nullable();
            $table->boolean('marked')->default(0);
            $table->timestamp('last_visit_at');
            $table->integer('total_time_taken');
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
        Schema::dropIfExists('answer_sheets');
    }
};
