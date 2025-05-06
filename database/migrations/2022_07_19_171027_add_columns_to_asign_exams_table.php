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
            $table->boolean('submitted')->default(0)->after('attended_at');
            $table->dateTime('submitted_at')->nullable()->after('attended_at');
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
            //
        });
    }
};
