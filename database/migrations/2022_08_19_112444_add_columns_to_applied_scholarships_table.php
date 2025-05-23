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
        Schema::table('applied_scholarships', function (Blueprint $table) {
            $table->unsignedBigInteger('exam_id')->after('scholarship_id');
            $table->foreign('exam_id')->references('id')->on('create_exams')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applied_scholarships', function (Blueprint $table) {
            //
        });
    }
};
