<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operatings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('expense_category');
            $table->string('expense_name');
            $table->date('date');
            $table->float('amount', 15, 2);
            $table->string('bank')->nullable();
            $table->string('reference')->nullable();
            $table->text('description')->nullable();
            $table->string('token')->nullable();
            $table->tinyInteger('status')->default('0');
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
        Schema::dropIfExists('operatings');
    }
}
