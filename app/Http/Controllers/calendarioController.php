<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class calendarioController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        
        return view('calendario.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
         return view('calendario.create');
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
            'dipendenti_id' => 'required'
            , 'commessa_id' => 'required'
                ], [
            'dipendenti_id.required' => 'dipendenti_id me lo devi dire'
            , 'commessa_id.required' => 'Se non mi dici per cosa è la commessa è inutile'
        ]);

        $calendario = new \App\calendario();

        $calendario->dipendenti_id = $request->input('dipendenti_id');
        $calendario->commessa_id = $request->input('commessa_id');

        \Debugbar::info($calendario);
        
        $calendario->save();

        return redirect('calendario.ok')->with('ok_message', 'Ok commessa aggiunta correttamente');
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
    }

}
