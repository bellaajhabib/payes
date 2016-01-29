<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//Nombre du Mois
define("NOMBERDUMOISJP", 12);
define("ROUNDVALUEJP", 3);
class JournalPaieCoutTotal extends Model
{
    //            $table->increments('id');

    protected $fillable = [
        'salaire_brut',
        'retenu_cnss',
        'salaier_imposable',
        'retenue_irpp',
        'salaier_net',
        'Charage_patronal',
        'tfp',
        'foprolos',
        'cout_total',
        'personnels_id',
    ];

    public function Personnels()
    {
        return $this->belongsTo('App\Personnels');
    }


    // return Retenu Cnss Mensuel
    public function getRetenuCnssAttribute($value)
    {
        return ($this->getMensuel($value));
    }
    // return salaire Brut Mensuel
    public function getSalaireBrutAttribute($value)
    {
        return ($this->getMensuel($value));
    }

    // return salaire  salaier imposable
    public function getSalaierImposableAttribute($value)
    {
        return ($this->getMensuel($value));
    }

    // return salaire  salaier net Mensuel
    public function getSalaierNetAttribute($value)
    {
        return ($this->getMensuel($value));
    }
    // return salaire  Charage Patronal  Mensuel
    public function getCharagePatronalAttribute($value)
    {
        return ($this->getMensuel($value));
    }

    // return salaire  irrp  Mensuel
    public function getRetenueIrppAttribute($value)
    {
        return ($this->getMensuel($value));
    }

    // return salaire  TFP  Mensuel
    public function getTfpAttribute($value)
    {
        return ($this->getMensuel($value));
    }

    // return salaire  Foprolos  Mensuel
    public function getFoprolosAttribute($value)
    {
        return ($this->getMensuel($value));
    }

    // return Coût Toal
    public function getCouttotalAttribute($value)
    {
        return ($this->getMensuel($value));
    }
    //
    public function getMensuel($value){

        return  number_format(($value/NOMBERDUMOISJP), ROUNDVALUEJP, '.', '');;
    }
}
