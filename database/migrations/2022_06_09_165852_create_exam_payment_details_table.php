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
        Schema::create('exam_payment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('application_id');
            $table->foreign('application_id')->references('id')->on('applied_scholarships')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('from', 100);
            $table->string('amount', 10);
            $table->string('transaction_id', 100);
            $table->date('payment_Date');
            $table->string('payment_through', 100);
            $table->text('payment_receipt');
            $table->enum('status', ['Under Review', 'Approved', 'Canceled']);
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
        Schema::dropIfExists('exam_payment_details');
    }
};
