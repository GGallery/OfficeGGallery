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
        \Debugbar::info('index');
        return view('calendario.create');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        \Debugbar::info('create');
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
        \Debugbar::info('store');
        
        $this->validate($request, [
            'dipendenti_id' => 'required'
            , 'commessa_id' => 'required'
            , 'n_ore' => 'required'
            , 'giorno' => 'required'
                ], [
            'dipendenti_id.required' => 'dipendenti_id me lo devi dire'
            , 'commessa_id.required' => 'Se non mi dici per cosa è la commessa è inutile'
            , 'n_ore.required' => 'Inserisci il numero di ore'
            , 'giorno.required' => 'Insrisci il giorno'
        ]);

        $calendario = new \App\calendario();

        $calendario->dipendenti_id = $request->input('dipendenti_id');
        $calendario->commessa_id = $request->input('commessa_id');
        $calendario->n_ore = $request->input('n_ore');
        $calendario->giorno = $request->input('giorno');

        try{
        $calendario->save();
            }
        catch(Exception $e){
             // do task when error
             \Debugbar::addException($e);
        }


        return redirect('calendario')->with('ok_message', 'Ok commessa aggiunta correttamente');
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
