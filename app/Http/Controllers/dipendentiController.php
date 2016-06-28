<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dipendentiController extends Controller {

    //
    public function index() {
        $data['dipendenti'] = \App\dipendenti::all();

        return view('dipendenti.index', compact('data'));
    }

    public function edit($id) {
        $data['datiRecuperati'] = \App\dipendenti::find($id);
        return view('dipendenti.edit', $data);
    }

}
