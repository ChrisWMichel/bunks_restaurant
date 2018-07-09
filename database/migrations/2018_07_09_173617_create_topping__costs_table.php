<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToppingCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topping__costs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('size_id')->unsigned();
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->string('cost');
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
        Schema::dropIfExists('topping__costs');
    }
}
