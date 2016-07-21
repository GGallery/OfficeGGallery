<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use App\User;

class usersController extends Controller {

    //
    public function index() {

        $data = User::with('societa')->get();

        \Debugbar::info(compact($data));

        return view('users.index', compact('data'));
    }

    public function edit($id) {

        $data['datiRecuperati'] = User::first();

        return view('users.edit', compact($data));
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

        $dipendente = \App\User::find($id);
        $dipendente->nome = $request->input('nome');
        $dipendente->cognome = $request->input('cognome');
        $dipendente->email = $request->input('email');

        $dipendente->save();

        return redirect('users')->with('ok_message', 'La tua rubrica è stata aggiornata');
    }

}
