<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('post');
            $table->string('nom');
            $table->string('prenom');
            $table->integer('nomber_jour');
            $table->integer('salaire_jour');
            $table->string('paiement_par');
            $table->bigInteger('cin');
            $table->string('cf');
            $table->integer('nb_enfant');
            $table->date('date_naissance');
            $table->date('date_entree');
            $table->integer('type_de_contrat_id');
            $table->date('date_de_fin_du_contrat');
            $table->string('num_cnss');
            $table->integer('conges_paye');
            $table->integer('nb_jour');
            $table->float('salaire_du_jour');
            $table->integer('rib_banque');
            $table->string('non_banque');
            $table->string('adresse_email');
            $table->integer('tele_personnel');
            $table->string('nationalites');
            $table->string('lieu_naissance');
            $table->string('fumez_vous');
            $table->string('etat_sante');
            $table->string('buvze_vous');
            $table->text('image');
            $table->float('indemnite_presence');
            $table->float('indemnite_transport');
            $table->integer('prime');
            $table->float('avance');
            $table->integer('deleted_at');
            $table->timestamps();


        });

        Schema::table('journal_paie_cout_totals',function(Blueprint $table){
          $table->integer('personnels_id')->unsigned()->index();
        });

        Schema::table('journal_paie_irpps',function(Blueprint $table){
            $table->integer('personnels_id')->unsigned()->index();
        });
        Schema::table('cnsses',function(Blueprint $table){
            $table->integer('personnels_id')->unsigned()->index();
        });

        Schema::table('conges',function(Blueprint $table){
            $table->integer('personnels_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('personnels');
    }
}
