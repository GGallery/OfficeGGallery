<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class societa extends Model {

    //
    protected $table = 'societa';

    
     public function dipendenti()
    {
        return $this->belongsToMany('App\dipendenti' , 'societa_id');
    }

    
    
    
    
}
