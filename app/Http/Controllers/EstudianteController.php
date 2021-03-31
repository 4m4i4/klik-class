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
    public function index($materia_id = 1)
    {   
        $user = auth()->user()->id;
        $materia=auth()->user()->materias;
       
        for($index=0;$index<$materia->count();$index++)echo $materia[$index]->id.' '. $materia[$index]->materia_name.'; ';
        //  dd($materia->count());
        // $materia = Materia::where('user_id',$user)->get();
        // $estudiantes = Estudiante::where('materia_id', $materia_id)->get();
        //   $estudiantes =Materia::leftJoin('estudiantes','id','=','estudiantes,materia_id')->paginate(20);

        // $materia_id =$estudiante->materia_id->first();
        $estudiantes = Estudiante::orderBy('materia_id','asc')->paginate(25);
                // $estudiantes = Estudiante::where('materia_id',$materia_id)->reorder('materia_id','asc')->paginate(25);
        return view('configurar.estudiantes.index', compact('estudiantes','materia','materia_id','user'));
    }

    public function porMateria($materia_id){
        $user = auth()->user()->id;
        $materia = Materia::where('user_id',$user)->get();
        $estudiantes = Estudiante::where('materia_id', $materia_id)->reorder('materia_id','asc')->paginate(25);
        return view('configurar.estudiantes.index', compact('estudiantes','materia','materia_id'));
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
        // TO-DO: validación de lista de estudiantes

        $materia_id = request('materia_id');
        $cadena = request('lista_completa');
        $cuantos = 1;
        // dd($request->input('lista_completa'));
        // dd(  $cadena);
        // Si la cadena acaba en punto y coma, lo quitamos
        if(Str::endsWith($cadena,';')) $cadena = Str::beforeLast($cadena,';');
        // obtenemos el array de estudiantes
        $arrApellidosNombre = Str::of($cadena)->explode(";");
        $num_estudiantes = count($arrApellidosNombre);

        // recorrer el array, asignar nombre y apellidos (separados por coma) a las variables
        for ($i = 0; $i < $num_estudiantes; $i++) { 
            $estudiante = Str::of( $arrApellidosNombre[$i])->explode(",");
            $apellidos = $estudiante[0];
            $nombre = Str::of($estudiante[1])->trim();
            $nombre_completo = $nombre." ".$apellidos;
            // crear el nuevo registro y atribuir sus propiedades
            $estudiante = new Estudiante([
                'nombre'=>$nombre,
                'apellidos'=>$apellidos,
                'nombre_completo'=>$nombre_completo,
                'materia_id'=>$materia_id
            ]);

            // Crear el mensaje informativo para el usuario y guardar el registro
            $mns_estudiantes ='Se han añadido '.$cuantos.' estudiantes';
            $estudiante->save();
            $cuantos++;
        }
        return redirect()->route('materias.index')->with('success', $mns_estudiantes);
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
        $estudiante = Estudiante::find($id);
        return view('configurar.estudiantes.edit', compact( 'estudiante'));
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
                'nombre' =>'required',
                'apellidos' =>'required',
                ])
            )
        {   $estudiante=Estudiante::find($id);
            $nombre = request('nombre');
            $apellidos = request('apellidos');
            $estudiante->nombre = $nombre;
            $estudiante->apellidos = $apellidos;
            $estudiante->nombre_completo = $nombre." ".$apellidos;
            $estudiante->materia_id = request('materia_id');

            $estudiante->save();
        }

        return redirect()->route('estudiantes.porMateria',$estudiante->materia_id);   
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudiante $estudiante)
    {
        $mns_estudiante ='Estudiante borrado con éxito';
        $estudiante->delete();
        return redirect()->route('materias.index')->with('success', $mns_estudiante);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function borrarGrupo($materia_id)
    {
        $mns_grupo ='Grupo borrado con éxito';
        $estudiantes = Estudiante::where('materia_id',$materia_id)->get();
        foreach($estudiantes as $estudiante)
        $estudiante->delete();
        
        return redirect()->route('materias.index')->with('success', $mns_grupo);
    }
}
