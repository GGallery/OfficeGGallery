<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommesseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('commesse', function(Blueprint $table) {
            $table->increments('id');
            $table->string('protocollo');
            $table->string('cliente');
            $table->string('oggetto');
            $table->string('stato');
            $table->string('referente');
            $table->string('colore');
            $table->integer('grafico');
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
        Schema::drop('commesse');
    }
}
