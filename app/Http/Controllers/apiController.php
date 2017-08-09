<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Hash;

use JWTAuth;

use DB;

use Carbon\Carbon;

use \App\calendario;

class APIController extends Controller

{



    public function register(Request $request){

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        User::create($input);
        return response()->json(['result'=>true]);
    }



    public function login(Request $request){

        $input = $request->all();
 
        if (!$token = JWTAuth::attempt($input)) {

            return response()->json(['result' => 'wrong email or password.', 'valid' => 'false']);
        }
        return response()->json(['result' => $token, 'valid' => 'true']);
    }

    public function get_user_details(Request $request){

        $input = $request->all();

        $user = JWTAuth::toUser($input['token']);

        return response()->json(['result' => $user]);
    }


    public function commesse_mie(Request $request){
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

    public function commesse_all( ){
        $id = 1;

        $data = DB::table('cm_commesse')
            ->orderBy('cm_commesse.id', 'desc')
            ->distinct()
            ->get();

//        return view('welcome');
        return response()->json($data);
    }

    public function getAssenti( ){
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


    public function commessa_store(Request $request){

        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);


        $calendario = new \App\calendario();

        $calendario->dipendenti_id = $user->id;
        $calendario->commessa_id = $request->input('commessa_id');
        $calendario->n_ore = $request->input('n_ore');


        $giorno = $request->input('giorno');
        $ora = $request->input('dalle_ore');

        $calendario->giorno = Carbon::createFromFormat('Y-m-d H', $giorno.' '. $ora );

        $calendario->type= $request->input('type');


        //        1 Ferie**
        //        2 Permesso**
        //        3 Straordinario **
        //        4 Recupero+
        //        5 Recupero- **
        //        6 Malattia/Mutua
        //	      7 Trasferta **




        $da_approvare= \App\assenzatipi::lists('da_approvare', 'id')->toArray();


        if($da_approvare[$calendario->type]) {
            $response['approvato'] = 'false';
            $calendario->approvato = 0;
        }
        else {
            $calendario->approvato = 1;
            $response['approvato'] = 'true';
        }

        \Debugbar::info($calendario->approvato, "approvato?");


        try {
            $calendario->save();
            $response['esito'] = 'true';
        } catch (Exception $e) {
            $response['esito'] = 'false';
            \Debugbar::addException($e);
        }

        if(!$calendario->approvato)
        {
            $referente = User::where('id', $user->referente_id)->first();

            \Debugbar::info($referente->email);

            Mail::send('emails.approvazione', ['user' => $referente->nome], function ($m) use ($referente) {
                $m->from('office@ggallery.it', 'G A P');
//                $m->to($referente->email, $referente->name)->subject('Richiesto intervento');
                $m->to('antonio@gallerygroup.it', $referente->name)->subject('Richiesto intervento');
            });
        }

        return response()->json($response);
    }


     public function get_calendario(Request $request) {
        //

        $cur_data = $request['giorno'];

        // $fromDate = Carbon::createFromFormat('Y-m-d', $cur_data)->startOfWeek()->toDateString(); // or ->format(..)
        // $tillDate = Carbon::createFromFormat('Y-m-d', $cur_data)->startOfWeek()->addDays(6)->toDateString();

        //for ($i = 0; $i < 6; $i++) {
          //  $tillDate = Carbon::createFromFormat('Y-m-d', $cur_data)->startOfWeek()->addDays($i)->toDateString();

         //   $d = Carbon::createFromFormat('Y-m-d', $cur_data)->startOfWeek()->addDays($i)->formatLocalized('%A %d/%m/%y');


        $giorno = Carbon::createFromFormat('Y-m-d', $cur_data)->toDateString();


        $user = JWTAuth::toUser($request['token']);

            $commesse  = calendario::where('dipendenti_id', $user->id)
                ->wheredate('giorno','=', $giorno)
                ->where('approvato' , '1')
                ->with('commessa')
                ->get();

            $totore = calendario::where('dipendenti_id', $user->id)
                ->wheredate('giorno','=', $giorno)
                ->where('approvato' , '1')
                ->with('commessa')
                ->sum('n_ore');
        






$res['commesse'] = $commesse;
$res['totore'] = $totore;
return response()->json($res);

    }


}