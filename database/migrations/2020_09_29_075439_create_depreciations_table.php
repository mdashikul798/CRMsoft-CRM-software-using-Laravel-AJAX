<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepreciationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depreciations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_id');
            $table->string('asset_name');
            $table->float('purchase_price', 15, 2);
            $table->float('percent')->default('0');
            $table->float('accumulated', 15, 2)->default('0');
            $table->float('depreciation', 15, 2)->default('0');
            $table->float('present_value', 15, 2);
            $table->date('purchase_date');
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
        Schema::dropIfExists('depreciations');
    }
}
