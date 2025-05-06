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
        Schema::create('exam_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->foreign('exam_id')->references('id')->on('create_exams');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->text('question');
            $table->string('a', 100);
            $table->string('b', 100);
            $table->string('c', 100);
            $table->string('d', 100)->nullable();
            $table->string('e', 100)->nullable();
            $table->string('f', 100)->nullable();
            $table->string('answer', 100)->nullable();
            $table->text('illustration')->nullable();
            $table->text('image')->nullable();
            $table->text('direction')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('exam_questions');
    }
};
