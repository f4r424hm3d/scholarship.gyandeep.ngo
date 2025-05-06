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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('image_name', 150)->nullable();
            $table->text('image_path')->nullable();
            $table->text('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('post_by', 100)->nullable();
            $table->date('event_date')->nullable();
            $table->time('time_start')->nullable();
            $table->time('time_end')->nullable();
            $table->text('video_link')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('events');
    }
};
