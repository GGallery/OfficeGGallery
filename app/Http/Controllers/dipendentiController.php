<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\dipendenti;
use App\user;

class dipendentiController extends Controller {

    //
    public function index() {

        $data = user::with('societa')->get();
        
        
        
        return view('dipendenti.index', compact('data'));
    }

    public function edit($id) {
        $data['datiRecuperati'] = \App\dipendenti::find($id);
        return view('dipendenti.edit', $data);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'nome' => 'required'
            , 'cognome' => 'required'
            , 'email' => 'required|email'
                ], [
            'nome.required' => 'Il nome è obbligatorio!'
            , 'cognome.required' => 'Per favore, anche il cognome'
            , 'email.required' => 'E l\'email è importante'
            , 'email.email' => 'L\'email non è in formato corretto'
        ]);

        $dipendente = \App\dipendenti::find($id);
        $dipendente->nome = $request->input('nome');
        $dipendente->cognome = $request->input('cognome');
        $dipendente->email = $request->input('email');

        $dipendente->save();

        return redirect('dipendenti')->with('ok_message', 'La tua rubrica è stata aggiornata');
    }

}
