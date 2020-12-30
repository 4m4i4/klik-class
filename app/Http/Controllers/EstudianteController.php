<?php

namespace App\Http\Controllers;
use App\Models\Estudiante;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = auth()->user()->id;
        $materias = Materia::where('user_id',$user)->get();
        //  dd($materias);
        $estudiantes=Estudiante::orderBy('materia_id')->get();
        // $estudiantes=Estudiante::with('materia')->get();
        return view('configurar.estudiantes.index',compact('estudiantes','materias','user'));
    }
    public function porMateria($id){
        // $user = auth()->user()->id;
        $materias = Materia::find($id);
        $id=$materias->id;
        
        // $id=$materia->id;
        $estudiantes=Estudiante::where('materia_id',$id)->get();
        return view('configurar.estudiantes.index',compact('estudiantes','materias'));
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configurar.estudiantes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        $cadena = request('lista_completa');
        $materia_id = request('materia_id');
        $arrApellidosNombre = Str::of($cadena)->explode(";");
        $num_estudiantes = count($arrApellidosNombre);

        for ($i=0; $i <$num_estudiantes; $i++) { 
            $estudiante = Str::of( $arrApellidosNombre[$i])->explode(",");
            $apellidos = $estudiante[0];
            $nombre = $estudiante[1];
            $nombre_completo = $nombre." ".$apellidos;
            

            $estudiante = new Estudiante([
                'nombre'=>$nombre,
                'apellidos'=>$apellidos,
                'nombre_completo'=>$nombre_completo,
                'materia_id'=>$materia_id
            ]);
            // if($estudiante->validate(['nombre_completo'=>'unique:estudiantes']))
            // {   
            $mns_estudiantes ='Se han añadido todos los Estudiantes';
            $estudiante->save();
            // }
        }
        return redirect()->route('estudiantes.index')->with('success', $mns_estudiantes);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
