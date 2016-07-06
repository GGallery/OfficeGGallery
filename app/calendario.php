<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class calendario extends Model
{
    //
    protected $table="cm_calendario";

public function commessa(){
        return $this->belongsTo('App\commesse' , 'commessa_id');
    }

}
