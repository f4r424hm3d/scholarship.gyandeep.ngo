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
        Schema::create('exam_instructions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->foreign('exam_id')->references('id')->on('create_exams')->cascadeOnDelete();
            $table->integer('subject_id');
            $table->integer('noq')->nullable();
            $table->integer('max_marks')->nullable();
            $table->integer('p_marks')->nullable();
            $table->integer('n_marks')->nullable();
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
        Schema::dropIfExists('exam_instructions');
    }
};
