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

        return $this->belongsTo('App\societa');
    }


    public function groups()
    {
        return $this->belongsToMany('\App\Usergroups' , 'user_group' , 'user_id', 'group_id' );
    }


    public function commesse()
    {
        return $this->belongsToMany('\App\commesse' , 'cm_calendario', 'dipendenti_id' , 'commessa_id');
    }



    public function getFullName()
    {
        return $this->cognome. " " . $this->nome;
    }


    public function hasAnyGroups($groups)
    {
        if(is_array($groups))
        {
            foreach ($groups as $group) {
                if($this->hasGroup($group))
                    return true;
            }
        }
        else
        {
            if($this->hasGroup($groups))
                return true;
        }
        return false;
    }


    public function hasGroup($group)
    {
        $chk = $this->groups()->where('name', $group)->first();
        \Debugbar::info($chk);
        if($chk){
            return true;
        }
        return false;
    }

//
//




}
