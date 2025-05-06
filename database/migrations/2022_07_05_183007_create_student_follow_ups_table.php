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
        Schema::create('student_follow_ups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnDelete();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete()->cascadeOnDelete();
            $table->string('lead_status', 200)->nullable();
            $table->string('lead_sub_status', 200)->nullable();
            $table->text('comment')->nullable();
            $table->string('followup_type', 200)->nullable();
            $table->string('followup_status', 200)->nullable();
            $table->date('next_followup_date')->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('student_follow_ups');
    }
};
