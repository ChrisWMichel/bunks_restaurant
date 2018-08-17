<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderedToppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordered_toppings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_history_id')->unsigned();
            $table->foreign('order_history_id')->references('id')->on('order_histories');
            $table->string('topping');
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
        Schema::dropIfExists('ordered_toppings');
    }
}
