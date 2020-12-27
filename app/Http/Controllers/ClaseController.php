<?php

namespace App\Http\Controllers;
use App\Models\Materia;
use App\Models\Aula;
use App\Models\Sesion;
use App\Models\Clase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
        if(Auth::check()){
            $user = Auth::user()->id;
            $materias = Materia::where('user_id',$user)->get();
            $aulas= Aula::where('user_id',$user)->get();
            $clases = Clase::where('user_id',$user)->with('user','materia','aula','sesion')->get();
            return view('configurar.clases.index', compact('materias','aulas','clases'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user()->id;
         $materias = Materia::where('user_id',$user)->get();
         $aulas = Aula::where('user_id',$user)->get();
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
                'sesion_id'=>'required',  
                'dia' =>'required',
                'user_id' => 'required',
                'materia_id'=>'required',
                'aula_id'=>'required',
            ])
         )
         {
             $clase = new Clase([
                'sesion_id'=>request('sesion_id'),                
                'dia'=>request('dia'),
                'user_id'=>request('user_id'),
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
    public function edit(Clase $clase)
    {
        // $user = auth()->user()->id;
        // $clase = Clase::where('user_id',$user)
        // ->with('materia','aula','sesion')->get();
        return view('configurar.clases.edit', compact( 'clase'));    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clase $clase)
    {
        if($request->validate([
                // 'materia' =>'required|string',
                'dia' =>'required',
                'sesion_id'=>'required',
                'user_id' => 'required',
                'materia_id'=>'required',
                'aula_id'=>'required',
            ])
         )
         {
            // $clase = Clase::find($id);
            $clase->dia = request('dia');
            $clase->sesion_id = request('sesion_id');
            $clase->user_id = request('user_id');
            $clase->materia_id = request('materia_id');
            $clase->aula_id = request('aula_id');
            $clase->save();
            
            return redirect()->route('clases.index')->with('info', 'Clase actualizada');
         }
    }
    // public function paso(User $user)
    // {
    //     $user->paso = request('paso');
    //     $user->save();
    //     $mensaje = "paso 2"  ;
    //     if($user->paso == 3) $mensaje = "paso 3";
    //     return redirect( url()->previous())->with('success', $mensaje."Pasooooo, pasitos de Gesmar");
    // }
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
