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
        Schema::create('lead_sub_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('lead_statuses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('sub_status', 100);
            $table->string('sub_status_slug', 100);
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
        Schema::dropIfExists('lead_sub_statuses');
    }
};
