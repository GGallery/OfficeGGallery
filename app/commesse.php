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
                ->with('clienti')
                ->paginate(15);
    }

//    public function analisi(){
//        $search =   Input::get('search');
//        $from=   Input::get('from');
//        $to =   Input::get('to');
//
////        User::whereHas('groups', function($q)
////        {
////            $q->where('group_id','=' , 3); //gruppo tutor
////        })->lists('nome', 'id')
////
//
//
//        return \App\calendario::with('commesse')
//            ->
//            ->paginate(15);
//    }



    
}
