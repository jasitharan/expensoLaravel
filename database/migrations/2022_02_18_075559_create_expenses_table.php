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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->date('createdDate');
            $table->string('receiptPath');
            $table->float('expenseCost');
            $table->string('expenseFor');
            $table->string('otherExpense');
            $table->string('rentalAgency');
            $table->string('carClass');
            $table->string('ticketNo');
            $table->string('airline');
            $table->integer('daysInHotel');
            $table->string('hotelName');
            $table->unsignedBigInteger('expenseType_id');
            $table->foreign('expenseType_id')->references('id')->on('expense_types')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('expenses');
    }
};
