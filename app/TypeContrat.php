<?php

namespace App;
use App\Personnels;
use Illuminate\Database\Eloquent\Model;

class TypeContrat extends Model
{
    //
    protected $fillable = array('type_de_contrat');
     public function personnel(){

         return $this->hasMany('App\Personnels','type_de_contrat_id','id');
     }
}
