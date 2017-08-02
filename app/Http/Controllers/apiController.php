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

        $data = DB::table('cm_commesse')
            ->select('cm_commesse.*')
            ->join('cm_calendario', 'cm_commesse.id' , '=' , 'cm_calendario.commessa_id' )
            ->where('dipendenti_id', 1)
            ->where('commessa_id', ">" ,  1)
            ->orderBy('giorno', 'desc')
            ->distinct()
            ->take(10)
            ->get();

//        return view('welcome');
        return response()->json($data);
    }

    public function getAllCommesse(){
        $id = 1;

        $data = DB::table('cm_commesse')
            ->orderBy('cm_commesse.id', 'desc')
            ->distinct()
            ->get();

//        return view('welcome');
        return response()->json($data);
    }

    public function getAssenti(){
        $today = \Carbon\Carbon::today();
        $tomorrow = \Carbon\Carbon::tomorrow();

        $data['assenze_oggi'] = \App\calendario::where('type', '>' , 0)
            ->with('User')
            ->where('giorno' ,'>',$today)
            ->where('giorno' ,'<',$tomorrow)
            ->where('approvato' , 1)
            ->orderBy('giorno' ,'asc')
            ->get();

        $data['assenze_domani'] = \App\calendario::where('type', '>' , 0)
            ->with('User')
            ->where('giorno' ,'>',$tomorrow)
            ->where('approvato' , 1)
            ->orderBy('giorno' ,'asc')
            ->get();

        return response()->json($data);
        
//        return View::make('home')->with($data);
    }

    public function userAuth(Request $request){

        $email = $request->input('email');
        $password = $request->input('password');

//        echo $email. "". $password;

        $credential ['email'] = $email;
        $credential ['password'] = $password;


//        $data = \App\User::where('email' , $email)->where('password' , bcrypt($password))->select('api_token')->first();

//        return response()->json($data);

        return view('welcome');



    }

//    public function getAssentiFuturi(){
//        $today = \Carbon\Carbon::today();
//        $tomorrow = \Carbon\Carbon::tomorrow();
//
//        $data['assenze'] = \App\calendario::where('type', '>' , 0)
//            ->where('giorno' ,'>',$today)
//            ->where('giorno' ,'<',$tomorrow)
//            ->where('approvato' , 1)
//            ->orderBy('giorno' ,'asc')
//            ->get();
//
//        $data['assenze_domani'] = \App\calendario::where('type', '>' , 0)
//            ->where('giorno' ,'>',$tomorrow)
//            ->where('approvato' , 1)
//            ->orderBy('giorno' ,'asc')
//            ->get();
//
//        $data['ultime_commesse'] = \App\commesse::take(10)->orderBy('created_at', 'desc')->get();
//
//        return View::make('home')->with($data);
//    }
}
