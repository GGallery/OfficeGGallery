<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable,
        CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'nome', 'cognome', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    
    public function societa() {

        return $this->belongsTo('App\Societa');
    }


    public function roles()
    {
        return $this->belongsToMany('\App\Role' , 'user_roles' , 'user_id', 'role_id' );
    }

    public function hasAnyRoles($roles)
    {
        if(is_array($roles))
            {
            foreach ($roles as $role) {
                if($this->hasRole($role))
                return true;
            }
        }
        else
            {
              if($this->hasRole($roles))
                return true;   
            }
    return false;
    }


    public function hasRole($role)
    {
        if($this->roles()->where('name', $role)){
            return true;
        }
        return false;
    }





}
