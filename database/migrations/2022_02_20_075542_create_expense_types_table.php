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
        Schema::create('expense_types', function (Blueprint $table) {
            $table->id();
            $table->string('expType')->unique();
            $table->string('url_image');
            $table->date('createdDate')->default('2022/06/26');
            $table->string('modifedBy')->default('admin');
            $table->string('updatedDate')->default('2022/06/26');
            $table->decimal('expCostLimit',16,2);
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
        Schema::dropIfExists('expense_types');
    }
};
