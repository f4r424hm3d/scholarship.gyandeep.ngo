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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('email', 150)->unique();
            $table->integer('c_code')->nullable();
            $table->bigInteger('mobile')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('password');
            $table->rememberToken();
            $table->string('father', 150);
            $table->string('mother', 150);
            $table->bigInteger('father_mobile')->nullable();
            $table->bigInteger('mother_mobile')->nullable();
            $table->string('gender', 20)->nullable();
            $table->date('dob')->nullable();
            $table->string('nationality', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->bigInteger('zipcode')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->bigInteger('login_count')->nullable();
            $table->boolean('status');
            $table->string('lead_type', 100);
            $table->string('source', 100);
            $table->boolean('wapp');
            $table->boolean('called');
            $table->string('lead_status', 100)->nullable();
            $table->string('lead_sub_status', 100)->nullable();
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
        Schema::dropIfExists('students');
    }
};
