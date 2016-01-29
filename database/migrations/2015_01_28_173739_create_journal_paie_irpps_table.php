<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalPaieIrppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_paie_irpps', function (Blueprint $table) {
            $table->increments('id');
            $table->float('salaire_impossable');
            $table->float('salaire_impossable_annuel');
            $table->float('abttement');
            $table->float('deduction');
            $table->float('salaire_impossable_2');
            $table->float('irrp_annuel');
            $table->float('irrp_mensuel');
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
        Schema::drop('journal_paie_irpps');
    }
}
