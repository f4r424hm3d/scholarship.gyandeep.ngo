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
        Schema::create('scholarship_eligibilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scholarship_id');
            $table->foreign('scholarship_id')->references('id')->on('scholarships');
            $table->string('country', 150);
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
        Schema::dropIfExists('scholarship_eligibilities');
    }
};
