<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListesDemandsCongesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listes_demands_conges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_de_debut_conge');
            $table->date('date_de_fin_conge');
            $table->integer('nb_jouer_conge_demander');
            $table->integer('somme_conge_demander');
            $table->integer('nb_jour_de_conge_obtenu');
            $table->integer('nb_jour_de_conge_reste');
            $table->string('description');
            $table->integer('personnel_id');

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
        Schema::drop('listes_demands_conges');
    }
}
