<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prime extends Model
{    protected $fillable = ['description'];//

    public function personnel()
    {
        return $this->belongsToMany('App\Personnels')->withTimestamps();
    }
}
