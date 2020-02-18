<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Police;

class ControladorPolice extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {
        return view('polices');
    }

    public function index()
    {
        $pol = Police::all();
        return $pol->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pol = new Police();
        $pol->inicio_vigencia = $request->input('inicio_vigencia');
        $pol->fim_vigencia = $request->input('fim_vigencia');
        $pol->placa = $request->input('placa');
        $pol->valor = $request->input('valor');
        $pol->client_id = $request->input('client_id');
        $pol->save();
        return json_encode($pol);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pol = Police::find($id);
        if (isset($pol)) {
            return json_encode($pol);
        }
        return response('Apólice não encontrada', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $pol = Police::find($id);
        if (isset($pol)) {
            $pol->inicio_vigencia = $request->input('inicio_vigencia');
            $pol->fim_vigencia = $request->input('fim_vigencia');
            $pol->placa = $request->input('placa');
            $pol->valor = $request->input('valor');
            $pol->client_id = $request->input('client_id');
            $pol->save();
            return json_encode($pol);
        }
        return response('Apólice não encontrada', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pol = Police::find($id);
        if(isset($pol)) {
            $pol->delete();
            return response('OK', 200);
        }
        return response('Apólice não encontrada', 404);
    }
}
