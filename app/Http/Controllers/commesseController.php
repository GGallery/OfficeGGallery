<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\commesse;
use App\clienti;

class commesseController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        //$data = commesse::with('Clienti')->get();

            //client_id
        //952177561871-hm8l3lo1qdvrfofov433drj70e23l6aj.apps.googleusercontent.com
        //secret
        //3_R0EPdO7-XJAtvq-3Zsyz44

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
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
        $data['datiRecuperati'] = \App\commesse::find($id);

        $clienti_list = clienti::lists('nome', 'id');

        return view('commesse.edit', $data)->with('clienti_list', $clienti_list);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
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

}
