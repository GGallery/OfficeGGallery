<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class autocompleteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //SearchController.php
    public function Commesse() {
        $term = Input::get('term');

        $results = array();

        $queries = \DB::table('cm_commesse')
                ->where('oggetto', 'LIKE', '%' . $term . '%')
                ->orWhere('protocollo', 'LIKE', '%' . $term . '%')
                ->get();

        foreach ($queries as $query) {
            $results[] = [ 'id' => $query->id, 'value' => $query->protocollo . ' ' . $query->oggetto];
        }
        \Debugbar::info($results);
        return \Response::json($results);
    }

    public function Utenti() {
        $term = Input::get('term');

        $results = array();

        $queries = \DB::table('cm_dipendenti')
                ->where('nome', 'LIKE', '%' . $term . '%')
                ->orWhere('cognome', 'LIKE', '%' . $term . '%')
                ->get();

        foreach ($queries as $query) {
            $results[] = [ 'id' => $query->id, 'value' => $query->nome . ' ' . $query->cognome];
        }
        return \Response::json($results);
    }

}
