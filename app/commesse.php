<?php

namespace App;



use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class commesse extends Model
{
    //
    protected $table= 'cm_commesse';
    
    
    public function clienti(){
        return $this->belongsTo('App\Clienti' , 'cliente_id');
    }

    public function calendario(){
        return $this->hasMany('App\Calendario' , 'commessa_id');
    }
    
    public function lista(){
        $search =   Input::get('search');
        return \App\commesse::with('Clienti')
                ->orWhere('oggetto','like', '%'.$search.'%')
                ->orWhere('protocollo','like', '%'.$search.'%')
                ->paginate(15);
    }
    
}
