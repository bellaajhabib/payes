<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Nombre du Mois
define("NOMBERDUMOISIRRP", 12);
define("ROUNDVALUEIRRP", 3);

class JournalPaieIrpp extends Model
{
    //

    protected $fillable = [
        'salaire_impossable',
        'salaire_impossable_annuel',
        'abttement',
        'deduction',
        'salaire_impossable_2',
        'irrp_annuel',
        'irrp_mensuel',

        'personnels_id',
    ];

    public function Personnels()
    {
        return $this->belongsTo('App\Personnels');
    }

    // return salaire Brut Mensuel
    public function getSalaireimpossableAttribute($value)
    {
        return ($this->getMensuel($value));
    }

    public function getMensuel($value)
    {

        return number_format(($value / NOMBERDUMOISIRRP), ROUNDVALUEIRRP, '.', '');;
    }

}
