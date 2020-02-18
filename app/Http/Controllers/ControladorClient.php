<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;

class ControladorClient extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Client::all();
        return view('clients', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('novoclient');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cli = new Client();
        $cli->nome = $request->input('nome');
        $cli->cpf = $request->input('cpf');
        $cli->cidade = $request->input('cidade');
        $cli->uf = $request->input('uf');
        $cli->save();
        return redirect('/clients');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cli = Client::find($id);
        if (isset($cli)) {
            return view('editarcliente', compact('cli'));
        }
        return redirect('/clients');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cli = Client::find($id);
        if (isset($cli)) {
            $cli->nome = $request->input('nome');
            $cli->cpf = $request->input('cpf');
            $cli->cidade = $request->input('cidade');
            $cli->uf = $request->input('uf');
            $cli->save();
        }
        return redirect('/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cli = Client::find($id);
        if (isset($cli)) {
            $cli->delete();
        }
        return redirect('/clients');
    }

    public function indexJson()
    {
        $cli = Client::all();
        return json_encode($cli);
    }
}
