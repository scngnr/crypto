<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryptoorders', function (Blueprint $table) {
          $table->id();
          $table->string('orderId')->nullable();
          $table->string('symbol')->nullable();
          $table->string('status')->nullable();
          $table->string('clientOrderId')->nullable();
          $table->string('price')->nullable();
          $table->string('avgPrice')->nullable();
          $table->string('origQty')->nullable();
          $table->string('executedQty')->nullable();
          $table->string('cumQty')->nullable();
          $table->string('cumQuote')->nullable();
          $table->string('timeInForce')->nullable();
          $table->string('type')->nullable();
          $table->string('reduceOnly')->nullable();
          $table->string('closePosition')->nullable();
          $table->string('side')->nullable();
          $table->string('positionSide')->nullable();
          $table->string('stopPrice')->nullable();
          $table->string('workingType')->nullable();
          $table->string('priceProtect')->nullable();
          $table->string('origType')->nullable();
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
        Schema::dropIfExists('cryptoorders');
    }
}
