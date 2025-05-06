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
        Schema::table('students', function (Blueprint $table) {
            $table->string('father_occupation', 150)->nullable();
            $table->string('father_income', 150)->nullable();
            $table->string('mother_occupation', 150)->nullable();
            $table->string('mother_income', 150)->nullable();
            $table->string('cast_category', 50)->nullable();
            $table->string('handicaped', 10)->nullable();
            $table->string('aadhar', 30)->nullable();
            $table->string('passport_number', 30)->nullable();
            $table->string('passport_expiry_date', 30)->nullable();
            $table->bigInteger('alternative_mobile')->nullable();
            $table->bigInteger('parents_mobile')->nullable();
            $table->text('address')->nullable();
            $table->text('parmanent_address')->nullable();
            $table->string('parmanent_city', 150)->nullable();
            $table->string('parmanent_state', 150)->nullable();
            $table->string('parmanent_country', 150)->nullable();
            $table->string('parmanent_zipcode', 150)->nullable();
            $table->boolean('pd')->default(0);
            $table->boolean('ad')->default(0);
            $table->boolean('cd')->default(0);
            $table->boolean('doc')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
