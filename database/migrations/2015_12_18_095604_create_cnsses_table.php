<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCnssesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cnsses', function (Blueprint $table) {
            $table->increments('id');
            $table->float('retenue_cnss');
            $table->float('charge_patronale');
            $table->float('accident_de_travail');
            $table->float('cout_total_mensuel');
            $table->float('cout_total_trimestriel');
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
        Schema::drop('cnsses');
    }
}
