<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoiceNum');
            $table->string('income_name');
            $table->string('customer_name');
            $table->string('phone')->nullable();
            $table->string('bank_name')->nullable();
            $table->float('price', 15, 2);
            $table->float('due', 15, 2)->default('0');
            $table->text('description')->nullable();
            $table->float('total', 15, 2);
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
        Schema::dropIfExists('other_incomes');
    }
}
