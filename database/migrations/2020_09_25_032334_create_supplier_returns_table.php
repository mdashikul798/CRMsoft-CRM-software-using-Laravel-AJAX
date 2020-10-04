<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_returns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoiceNum');
            $table->string('item_code');
            $table->string('item_name');
            $table->string('supplier_name');
            $table->integer('return_quentity');
            $table->float('purchase_total', 15, 2);
            $table->date('purchase_date');
            $table->string('reason');
            $table->text('description')->nullable();
            $table->float('return_amount', 15, 2);
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
        Schema::dropIfExists('supplier_returns');
    }
}
