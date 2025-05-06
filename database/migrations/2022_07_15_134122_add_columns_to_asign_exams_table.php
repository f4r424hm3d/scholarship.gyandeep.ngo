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
        Schema::table('asign_exams', function (Blueprint $table) {
            $table->unsignedBigInteger('application_id')->after('id');
            $table->foreign('application_id')->references('id')->on('applied_scholarships');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asign_exams', function (Blueprint $table) {
        });
    }
};
