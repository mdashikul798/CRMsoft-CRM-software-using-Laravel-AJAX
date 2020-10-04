<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationaryPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stationary_purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoiceNum');
            $table->string('item_name');
            $table->string('supplier_name')->nullable();
            $table->integer('quentity')->nullable();
            $table->float('price', 15, 2);
            $table->text('description')->nullable();
            $table->string('reference')->nullable();
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
        Schema::dropIfExists('stationary_purchases');
    }
}
