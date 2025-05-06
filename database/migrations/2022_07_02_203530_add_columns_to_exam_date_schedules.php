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
        Schema::table('exam_date_schedules', function (Blueprint $table) {
            $table->unsignedBigInteger('scholarship_id')->after('id');
            $table->foreign('scholarship_id')->references('id')->on('scholarships');
            $table->unsignedBigInteger('course_category_id')->after('scholarship_id');
            $table->foreign('course_category_id')->references('id')->on('course_categories');
            $table->boolean('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_date_schedules', function (Blueprint $table) {
            //
        });
    }
};
