<?php

namespace App;


use App\TypeContrat;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Personnels extends Model
{
    //

    protected $fillable = [
        'post',
        'nom',
        'prenom',
        'nomber_jour',
        'salaire_jour',
        'paiement_par',
        'cin',
        'cf',
        'nb_enfant',
        'date_naissance',
        'date_entree',
        'type_de_contrat_id',
        'date_de_fin_du_contrat',
        'num_cnss',
        'conges_paye',
        'nb_jour',
        'salaire_du_jour',
        'indemnite_presence',
        'indemnite_transport',
        'avance',
        'deleted_at',
    ];

    public function maContrat()
    {

        return $this->belongsTo('App\TypeContrat', 'type_de_contrat_id', 'id');

    }

    public function scopegetContrat()
    {
        return TypeContrat::where('id', $this->type_de_contrat_id);
    }

    // ***************** Adapter le format  date d'entree  ******************************** //
    public function setDateEntreeAttribute($date)
    {
        $this->attributes['date_entree'] = Carbon::createFromFormat('d/m/Y', $date);
    }

    public function getDateEntreeAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }


    //*******************************************************************************************//

    // ***************** Adapter le format  date de Naissance ********************************** //

    public function getDateNaissanceAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setDateNaissanceAttribute($date)
    {
        $this->attributes['date_naissance'] = Carbon::createFromFormat('d/m/Y', $date);
    }
    // *********************************************************************************************/

    // *************************Adapter le format  date de fin du contrat****************************************************************** //
    public function setDateDeFinDuContratAttribute($date)
    {
        $this->attributes['date_de_fin_du_contrat'] = $date ? Carbon::createFromFormat('d/m/Y', $date) : null;


    }

    public function getDateDeFinDuContratAttribute($value)
    {
        if($this->asDateTime($value)=='None') return null;
        else {    return Carbon::parse($value)->format('d/m/Y');}

    }

    protected function asDateTime($value)
    {
        if (starts_with($value, '0000')) return 'None';

        return parent::asDateTime($value);
    }
    // ************************************************************************************************ //
    // return la perimer letter de Post en Majuscule
    public function getPostAttribute($value)
    {
        return ucfirst($value);
    }

    // Relation on to on Tabe Journal Paie Coût Toatl
    public function jpCoutTotals()
    {
        return $this->hasOne('App\JournalPaieCoutTotal');
    }

    public function jpIrpp()
    {
        return $this->hasOne('App\JournalPaieIrpp');
    }

    public function cnss()
    {
        return $this->hasOne('App\Cnss');
    }
   public function conges()
    {
        return $this->hasOne('App\Conges');
    }

    /**
     * * Get the tag associateed with primes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function primes(){
        return $this->belongsToMany('App\Prime')
            ->withPivot('montant_prime','updated_at','prime_order')
            -> withTimestamps();
    }


    /**********************FullName**************************************/
    public function getFullNameAttribute()
    {
        return $this->nom . " " . $this->prenom;
    }
}
