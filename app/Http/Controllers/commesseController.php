<?php

namespace App\Http\Controllers;

use App\calendario;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\commesse;
use App\clienti;
use App\User;

use Illuminate\Support\Facades\Input;

use DB;


class commesseController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $commesse = new \App\commesse();
        $data = $commesse->lista();
        return view('commesse.index', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $clienti_list = [''=>''] + clienti::orderBy('nome')->lists('nome', 'id')->all();
        $user= [''=>'']  +  user::where('bloccato' , 0)->orderBy('cognome')->lists('cognome', 'id')->all();
        $commesseg = commesse::where('abilitata', 1)->where('protocollo' , 'like' ,'G%')->orderBy('id', 'desc')->get();
        $commesseh = commesse::where('abilitata', 1)->where('protocollo' , 'like' ,'H%')->orderBy('id', 'desc')->get();

        return view('commesse.new')
            ->with('user', $user)
            ->with('commesseg', $commesseg)
            ->with('commesseh', $commesseh)
            ->with('clienti_list', $clienti_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        $this->validate($request, [
            'protocollo' => 'required'
            , 'cliente_id' => 'required'
            , 'oggetto' => 'required'
            , 'stato' => 'required'
            , 'referente' => 'required'
        ], [
            'protocollo.required' => 'Il protocollo è obbligatorio!'
            , 'cliente_id.required' => 'Cliente'
            , 'oggetto.required' => 'Oggetto'
            , 'referente' => 'Referente'
        ]);

        $commessa = new commesse;
        $commessa->protocollo= $request->input('protocollo');
        $commessa->cliente_id= $request->input('cliente_id');
        $commessa->oggetto= $request->input('oggetto');
        $commessa->stato= $request->input('stato');
        $commessa->referente= $request->input('referente');


        $commessa->save();

        return redirect('commesse')->with('ok_message', 'La tua commessa è stata inserita');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $data['clienti_list'] = [''=>''] + clienti::lists('nome', 'id')->all();
        $data['users']= [''=>'']  +  user::where('bloccato' , 0)->orderBy('cognome')->lists('cognome', 'id')->all();
        $data['datiRecuperati'] = commesse::where('abilitata', 1)->orderBy('id', 'desc')->find($id);
        return view('commesse.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $this->validate($request, [
            'protocollo' => 'required'
            , 'cliente_id' => 'required'
            , 'oggetto' => 'required'
            , 'stato' => 'required'
            , 'referente' => 'required'
        ], [
            'protocollo.required' => 'Il protocollo è obbligatorio!'
            , 'cliente_id.required' => 'Cliente'
            , 'oggetto.required' => 'Oggetto'
            , 'referente' => 'Referente'
        ]);

        $commessa = new commesse;
        $commessa->protocollo= $request->input('protocollo');
        $commessa->cliente_id= $request->input('cliente_id');
        $commessa->oggetto= $request->input('oggetto');
        $commessa->stato= $request->input('stato');
        $commessa->referente= $request->input('referente');


        $commessa->save();

        return redirect('commesse')->with('ok_message', 'La tua commessa è stata inserita');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        echo "ok";
    }


    public function userPerCommessa(){
        $id=Input::get('id');

        $data = \App\calendario::
            select('*', DB::raw('SUM(n_ore) as tot'))
            ->where('commessa_id', $id)
            ->where('type', '<>' , '5') //escludo i recuperi-   
            ->with('user')
            ->with('commessa')
            ->groupBy('dipendenti_id')
            ->get();


        $info = $data->first();

        $result['utenti'] = array();
        foreach ($data as $single){
            $user['nome']= $single->user->nome;
            $user['cognome']= $single->user->cognome;
            $user['tot']= $single->tot;
            $result['utenti'][]=$user;
        }

        $result['referente'] = $info->commessa->referente;
        $result['stato'] = $info->commessa->stato;
        $result['id'] = $info->commessa->id;

        return \Response::json($result);

    }

}
