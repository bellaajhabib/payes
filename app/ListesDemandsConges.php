<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ListesDemandsConges extends Model
{


    protected $fillable = [
        'nom',
        'prenom',
        'date_de_debut_conge',
        'date_de_fin_conge',
        'nb_jouer_conge_demander',
        'somme_conge_demander',
        'nb_jour_de_conge_obtenu',
        'nb_jour_de_conge_reste',
        'description',
        'personnel_id',

        ];

    public function getDateDeFinCongeAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }


    public function getDateDeDebutCongeAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getDescriptionAttribute($value)
    {
        return $value;
    }

    public function setDateDeDebutCongeAttribute($date)
    {
        $this->attributes['date_de_debut_conge'] = Carbon::createFromFormat('d/m/Y', $date);

    }
    public function setDateDeFinCongeAttribute($date)
    {
        $this->attributes['date_de_fin_conge'] =  Carbon::createFromFormat('d/m/Y', $date);

    }


}
