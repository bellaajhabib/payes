<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//Nombre du Mois
define("NOMBERDUMOISCNSS", 12);
define("ROUNDVALUECNSS", 3);
class Cnss extends Model
{
    //
    protected $fillable = [
        'retenue_cnss',
        'charge_patronale',
        'accident_de_travail',
        'cout_total_mensuel',
        'cout_total_trimestriel',
         'personnels_id',
    ];

    public function Personnels()
    {
        return $this->belongsTo('App\Personnels');
    }
    // return salaire  Retenue  Cnss
    public function getRetenueCnssAttribute($value)
    {
        return ($this->getMensuel($value));
    }
    // return  Charge Patronale
    public function getChargePatronaleAttribute($value)
    {
        return ($this->getMensuel($value));

    }    // return accident_de_travail
    public function getAccidentDeTravailAttribute($value)
    {
        return ($this->getMensuel($value));
    }
    // return cout_total_mensuel
    public function getCoutTotalMensuelAttribute($value)
    {
        return ($this->getMensuel($value));
    }

    public function getMensuel($value){

        return  number_format(($value/NOMBERDUMOISCNSS), ROUNDVALUECNSS, '.', '');;
}

}
