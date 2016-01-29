<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Config;

class Role extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Role belongs to many users.
     *
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(Config::get('auth.model'))->withTimestamps();
    }

    /**
     * Role belongs to many permissions.
     *
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Permission')->withTimestamps();
    }

    /**
     * Get all role permissions.
     *
     * @return array|null
     */
    public function getPermissions()
    {
        return $this->permissions->lists('name');
    }

    /**
     * Grant permission.
     *
     * @param $permission
     * @return mixed
     */
    public function grantPermission($permission)
    {
        return $this->permissions()->attach($permission);
    }

    /**
     * Revoke permission.
     *
     * @param $permission
     * @return mixed
     */
    public function revokePermission($permission)
    {
        return $this->permissions()->detach($permission);
    }

    /**
     * Grant multiple permissions to current role.
     *
     * @param $permissions
     * @return mixed
     */
    public function grantPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->attachPermission($permission);
        }
    }

    /**
     * Revoke multiple permissions from current role
     *
     * @param $permissions
     * @return mixed
     */
    public function revokePermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->detachPermission($permission);
        }
    }

}
