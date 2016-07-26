<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmCalendario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cm_calendario', function(Blueprint $table){
            $table->increments('id');
            $table->integer('dipendenti_id')->unsigned();
            $table->foreign('dipendenti_id')->references('id')->on('users');
            $table->string('giorno');
            $table->integer('commessa_id')->unsigned();
            $table->foreign('commessa_id')->references('id')->on('cm_commesse');
            $table->integer('n_ore');
            $table->integer('approvato');
            $table->integer('straordinario');
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
        //
        Schema::drop('cm_calendario');
    }
}
