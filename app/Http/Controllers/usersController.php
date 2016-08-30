<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use App\User;
use App\Usergroups;
use \App\societa;



class usersController extends Controller {

    //
    public function index() {

        $data = User::with('societa')->where('bloccato', 0)->orderBy('cognome')->get();
        return view('users.index', compact('data'));
    }

    public function edit($id) {

        $data['datiRecuperati'] = User::find($id);

        $data['societa'] = Societa::lists('societa', 'id');

        $data['leader'] = User::whereHas('groups', function($q)
        {
            $q->where('group_id','=' , 3); //gruppo tutor
        })->lists('nome', 'id');

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

        $user = User::find($id);
        $user->nome = $request->input('nome');
        $user->cognome = $request->input('cognome');
        $user->email = $request->input('email');
        $user->bloccato= $request->input('bloccato');
        $user->referente_id= $request->input('referente_id');

        $user->save();

        \Debugbar::info($request->input('groups'));


        if($request->input('groups')) {
            $user->groups()->detach();
            foreach ($request->input('groups') as $group) {
                $user->groups()->attach(Usergroups::where('id', $group)->first());
            }
        }

        return redirect('users')->with('ok_message', 'La tua rubrica è stata aggiornata');
    }

}
