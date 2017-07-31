<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
class apiController extends Controller
{
    //

    public function getMieCommesse(){

        $id = 1;
//
//        $data = \App\calendario::take(10)
//            ->select('commessa_id')
//            ->where('dipendenti_id',  $id)
//            ->where('commessa_id', ">" ,  1)
//            ->with('commessa')
//            ->orderBy('giorno', 'desc')
//            ->distinct()
//            ->get();


//        $data = \App\commesse::take(10)
//            ->whereHas('calendario', function($c){
//                $c
//                    ->where('dipendenti_id', 1)
//                    ->where('commessa_id', ">" ,  1)
//                    ->orderBy('giorno', 'desc')
//                    ->distinct();
//
//
//            })->get();

        $data = DB::table('cm_commesse')
            ->join('cm_calendario', 'cm_commesse.id' , '=' , 'cm_calendario.commessa_id' )
            ->where('dipendenti_id', 1)
            ->where('commessa_id', ">" ,  1)
            ->orderBy('giorno', 'desc')
            ->distinct()
            ->take(10)
            ->get();

//        return view('welcome');
        return response()->json([$data]);

    }
}
