<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoiceNum');
            $table->tinyInteger('category_id');
            $table->string('item_code')->nullable();
            $table->string('item_name');
            $table->string('customer_name');
            $table->string('bank_name')->nullable();
            $table->string('phone');
            $table->integer('quentity')->default('1');
            $table->float('price', 15, 2);
            $table->float('amountdue', 15, 2)->default('0');
            $table->float('discount', 15, 2)->nullable();
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
        Schema::dropIfExists('sales');
    }
}
