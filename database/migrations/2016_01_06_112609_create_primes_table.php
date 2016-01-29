<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->timestamps();
        });

        Schema::Create(
            'personnels_prime',
            function (Blueprint $table) {
                $table->integer('personnels_id')->unsigned()->index();
                $table->foreign('personnels_id')->references('id')->on('personnels')->onDelete('cascade');
                $table->float('montant_prime');
                $table->string('exoneree');
                $table->integer('prime_order');

                $table->integer('prime_id')->unsigned()->index();
                $table->foreign('prime_id')->references('id')->on('primes')->onDelete('cascade');
                $table->timestamps();

            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('primes');
        Schema::drop('personnel_prime');
    }
}
