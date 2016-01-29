<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description'];

	/**
     * Permission belongs to many roles.
     *
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

}
