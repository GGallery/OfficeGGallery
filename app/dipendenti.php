<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class dipendenti extends Model {

    //
    protected $table = "users";

    public function societa() {
        
        return $this->belongsTo('App\Societa');
        
    }
}
