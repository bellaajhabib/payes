<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCongesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nb_jour_conges');
            $table->integer('somme_conge_demander');
            $table->integer('nb_jour_de_conge_obtenu');
            $table->integer('nb_jour_de_conge_reste');
            $table->date('date_demande_conge');

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
        Schema::drop('conges');
    }
}
