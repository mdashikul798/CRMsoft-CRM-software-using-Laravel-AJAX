<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_returns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_id');
            $table->string('voucherNum');
            $table->string('item_name');
            $table->string('customer_name');
            $table->float('sales_total', 15, 2);
            $table->date('sales_date');
            $table->string('reason');
            $table->integer('return_quentity');
            $table->text('description')->nullable();
            $table->float('return_amount', 15, 2);
            $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('customer_returns');
    }
}
