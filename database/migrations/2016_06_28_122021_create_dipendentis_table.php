<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDipendentisTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user', function(Blueprint $table) {
            $table->increments('id');
            $table->string('cognome');
            $table->string('nome');
            $table->string('password');
            $table->integer('livello');
            $table->string('email');
            $table->integer('societa_id')->unsigned();
            $table->foreign('societa_id')->references('id')->on('societa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('dipendenti');
    }

}
