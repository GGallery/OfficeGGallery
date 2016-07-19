<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
    	return $this->belongToMany('\App\User',  'user_roles' , 'role_id', 'user_id' );
    }
}
