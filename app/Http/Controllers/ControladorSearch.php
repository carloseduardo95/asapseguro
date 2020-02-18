<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;

class ControladorSearch extends Controller
{
    public function indexView()
    {
        $cli = Client::all();
        return view('search');
    }

    public function consultaApolices()
    {
        $res = DB::table('polices')
                ->join('clients', 'clients.id', '=', 'polices.client_id')
                ->select('polices.placa', 'polices.valor')
                ->get();
        return $res->toJson();
    }
}
