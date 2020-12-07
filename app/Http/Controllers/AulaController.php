<?php

namespace App\Http\Controllers;
use App\Models\Aula;
use App\Models\Clase;
use App\Models\Mesa;
use App\Models\Materia;

use Illuminate\Http\Request;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aula = Aula::get();
        return view('configurar.aulas.index',compact('aula'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configurar.aulas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->validate([
                'aula_name' =>'required|string',
                'num_columnas' =>'required',
                'num_filas' =>'required',
                'num_mesas' =>'required',
            ])
         )
         {
             $aula = new Aula([
                'aula_name'=>request('aula_name'),
                'num_columnas'=>request('num_columnas'),
                'num_filas'=>request('num_filas'),
                'num_mesas'=>request('num_mesas'),
                 
             ]);
             $aula->save();
             return redirect()->route('aulas.index')->with('success', 'Aula añadida');
         }
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
        $aula = Aula::find($id);
        return view('configurar.aulas.edit', compact( 'aula'));
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
        if($request->validate([
                'aula_name' =>'required|string',
                'num_columnas' =>'required',
                'num_filas' =>'required',
                'num_mesas' =>'required',
            ])
         )
         {
            $aula = Aula::find('$id');
            $aula->aula_name = request('aula_name');
            $aula->num_columnas = request('num_columnas');
            $aula->num_filas = request('num_filas');
            $aula->num_mesas = request('num_mesas');
            $aula->save();
            return redirect()->route('aulas.index')->with('success', 'Aula actualizada');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aula = Aula::find($id);
        $aula->delete();
        return redirect()->route('aulas.index')->with('success', 'Aula borrada');
    }
}
