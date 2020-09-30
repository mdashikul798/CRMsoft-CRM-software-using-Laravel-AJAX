<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankActsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_acts', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('deposit_id')->nullable();
            $table->tinyInteger('withdrawal_id')->nullable();
            $table->string('bank');
            $table->string('reference')->nullable();
            $table->date('date');
            $table->float('amount', 15, 2);
            $table->string('invoiceNum');
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
        Schema::dropIfExists('bank_acts');
    }
}
