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
            $table->integer('level')->nullable();
            $table->integer('category')->nullable();
            $table->integer('subject')->nullable();
            $table->date('exam_date')->nullable();
            $table->string('mode_of_exam', 50)->nullable();
            $table->string('exam_center_1', 100)->nullable();
            $table->string('exam_center_2', 100)->nullable();
            $table->string('exam_center_3', 100)->nullable();
            $table->string('payment_status')->default('Pending');
            $table->string('exam_status')->nullable();
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
