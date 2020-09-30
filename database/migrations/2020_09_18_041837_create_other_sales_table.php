<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoiceNum');
            $table->string('item_name');
            $table->string('customer_name');
            $table->string('phone')->nullable();
            $table->double('price');
            $table->double('amountDue')->default('0');
            $table->text('description')->nullable();
            $table->double('total');
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
        Schema::dropIfExists('other_sales');
    }
}
