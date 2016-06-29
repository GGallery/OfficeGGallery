<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class dipendenti extends Model {

    //
    protected $table = "dipendenti";

    public function societa() {
        
        return $this->hasOne('App\Societa' , 'societa_id');
        
    }
}