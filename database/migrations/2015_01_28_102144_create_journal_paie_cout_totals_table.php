<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalPaieCoutTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_paie_cout_totals', function (Blueprint $table) {
            $table->increments('id');
            $table->float('salaire_brut');
            $table->float('retenu_cnss');
            $table->float('salaier_imposable');
            $table->float('retenue_irpp');
            $table->float('salaier_net');
            $table->float('charage_patronal');
            $table->float('tfp');
            $table->float('foprolos');
            $table->float('cout_total');
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
        Schema::drop('journal_paie_cout_totals');
    }
}
