<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToppingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topping__items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topping_cat_id')->unsigned();
            $table->foreign('topping_cat_id')->references('id')->on('topping_cats');
            $table->string('item');
            $table->boolean('double_price')->default(0);
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
        Schema::dropIfExists('topping__items');
    }
}
