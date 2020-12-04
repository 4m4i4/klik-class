<?php

namespace App\Http\Controllers;
use App\Models\Materia;
use App\Models\Aula;
use App\Models\Sesion;
use App\Models\Clase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClaseController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materias = Materia::get();
        $aulas= Aula::get();
               return view('configurar.clases.index', compact('materias','aulas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $materias = Materia::get();
         $aulas = Aula::get();
        return view('configurar.clases.create', compact('materias','aulas'));
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
               
                'dia' =>'required',
            ])
         )
         {
             $clase = new Clase([
                
                'dia'=>request('dia'),
                'sesion_id'=>request('sesion_id'),
                'materia_id'=>request('materia_id'),
                'aula_id'=>request('aula_id')
                 
             ]);
             $clase->save();
             return redirect()->route('clases.index')->with('info', 'Clase añadida');
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
        $b_clase = Clase::find($id);
        return view('configurar.clases.edit', compact( 'b_clase'));    }

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
                'materia' =>'required|string',
                'dia' =>'required|string',
            ])
         )
         {
            $clase = Clase::find('$id');
            $clase->dia = request('dia');
            $clase->sesion_id = request('sesion_id');
            $clase->materia_id = request('materia_id');
            $clase->aula_id = request('aula_id');
            $clase->save();
            
            return redirect()->route('clases.index')->with('info', 'Clase actualizada');
         }
    }
    public function paso(User $user)
    {
        $user->paso = request('paso');
        $user->save();
        $mensaje = "paso 2"  ;
        if($user->paso == 3) $mensaje = "paso 3";
        return redirect( url()->previous())->with('success', $mensaje."Pasooooo, pasitos de Gesmar");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clase = Clase::find($id);
        $clase->delete();
        return redirect()->route('clases.index')->with('info', 'Clase borrada');
    }
}
