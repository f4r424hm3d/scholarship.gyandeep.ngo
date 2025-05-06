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
        Schema::table('providers', function (Blueprint $table) {
            $table->string('name', 150);
            $table->string('email', 150);
            $table->integer('c_code')->nullable();
            $table->bigInteger('mobile')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('password');
            $table->rememberToken();
            $table->string('gender', 20)->nullable();
            $table->date('dob')->nullable();
            $table->string('nationality', 100)->nullable();
            $table->bigInteger('zipcode')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->bigInteger('login_count')->nullable();
            $table->integer('otp')->nullable();
            $table->string('otp_expire_at', 100)->nullable();
            $table->boolean('email_verified')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('providers', function (Blueprint $table) {
            //
        });
    }
};
