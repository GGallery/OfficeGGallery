<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class societa extends Model {

    //
    protected $table = 'cm_societa';

    
     public function dipendenti()
    {
        return $this->hasMany('App\User');
    }

    
     public function user()
    {
        return $this->hasMany('App\user');
    }
    
    
}
