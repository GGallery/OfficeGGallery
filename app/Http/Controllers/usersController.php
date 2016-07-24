<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use App\User;
use App\Usergroups;



class usersController extends Controller {

    //
    public function index() {

        $data = User::with('societa')->get();
        return view('users.index', compact('data'));
    }

    public function edit($id) {

        $data['datiRecuperati'] = User::find($id);

        $data['leader'] = User::with(['groups' =>function ($query){
                $query->where('group_id','=' , 3);
        }])->lists('nome', 'id');

        $usergroups = new Usergroups();
        $data['usergroups'] = $usergroups->getTree();

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

        \Debugbar::info($request->input('groups'));


            $dipendente->groups()->detach();
            foreach ($request->input('groups') as $group) {
                $dipendente->groups()->attach(Usergroups::where('id', $group)->first());
            }



        return redirect('users')->with('ok_message', 'La tua rubrica è stata aggiornata');
    }

}
