<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conges extends Model
{

    //
    protected $fillable = [
        'nb_jour_conges',
        'date_demande_congee',

    ];
    public function Personnels()
    {
        return $this->belongsTo('App\Personnels');
    }
}
