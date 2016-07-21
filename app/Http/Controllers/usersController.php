<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use App\User;
use App\Role;

class usersController extends Controller {

    //
    public function index() {

        $data = User::with('societa')->get();
        return view('users.index', compact('data'));
    }

    public function edit($id) {

        $data['datiRecuperati'] = User::with('roles')->find($id);

//        \Debugbar::info($data['datiRecuperati']->roles()->);

        $data['userType'] = Role::lists('name', 'id');
        return view('users.edit', $data);

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

        if($request->input('auth')) {
            $dipendente->roles()->detach();
            $dipendente->roles()->attach(Role::where('id', $request->input('auth'))->first());
        }


        return redirect('users')->with('ok_message', 'La tua rubrica è stata aggiornata');
    }

}
