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
    
    public function lista(){
        
        
        $search =   Input::get('search');
        
        return \App\commesse::with('Clienti')
                ->where('oggetto','like', '%'.$search.'%')
                ->paginate(15);
    }
    
    
}
