<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class societa extends Model {

    //
    protected $table = 'cm_societa';

    
     public function dipendenti()
    {
        return $this->hasMany('App\dipendenti');
    }

    
    
    
    
}
