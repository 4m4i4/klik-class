<?php

namespace App\Http\Controllers;
use App\Models\Mesa;
use App\Models\Clase;
use App\Models\Materia;
use App\Models\Aula;
use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class MesaController extends Controller
{
     use AuthenticatesUsers;
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user()->id;
        $aula_id = Aula::where('user_id',$user)->value('id');
        $clase = Clase::where('user_id',$user)->with('materia','sesion')->get();
        $estudiantes = Estudiante::get();
        $mesas = Mesa::all();
        return view('configurar.mesas.index', compact('mesas','estudiantes','clase','aula_id'));
    }

    public function mesasPorClase(Clase $clase){ 
        $mesas = Mesa::where('clase_id',$clase->id)->with('clase','aula','estudiante')->get();
        return response()->json($mesas)->header('Content-Type','application/json');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('configurar.mesas.create');
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
            'columna'=>'required|integer',
            'fila'=>'required|integer',
            'is_ocupada'=>'nullable|boolean',
            'clase_id'=>'required|integer',
            'aula_id'=>'required|integer',
            'estudiante_id'=>'nullable|integer',
            ])
        )
        {   
            $mesa = new Mesa([
                'columna'=>request('columna'),
                'fila'=>request('fila'),
                'is_ocupada'=>request('is_ocupada'),
                'clase_id'=>request('clase_id'),
                'aula_id'=>request('aula_id'),
                'estudiante_id'=>request('estudiante_id'),
            ]);
               
            $mesa->save();
            return redirect()->route('mesas.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mesa $mesa){ }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Mesa $mesa) { }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Mesa $mesa) {  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Mesa $mesa)
    {
        $mns_mesa ='Mesa borrada con éxito';
        $mesa->delete();
        return redirect()->route('mesas.index')->with('info', $mns_mesa);
    }
 }
