<?php

namespace App\Http\Controllers;
use App\Models\Estudiante;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

    public function index($id=1)
    {   
        $user = auth()->user()->id;
        $materia = auth()->user()->materias;
        // for($index = 0; $index < $materia_count; $index++) echo $materia[$index]->id.' '. $materia[$index]->materia_name.'; ';
        $current = url()->current();
        $materia_id = Str::after($current, 'estudiantes/');
        $estudiantes = Estudiante::where('user_id',$user)->get();
        // $estudiantes = Estudiante::where('materia_id',$materia_id)->reorder('materia_id','asc')->paginate(25);
        return view('configurar.estudiantes.index', compact('materia','id','estudiantes','user','materia_id'));
    }

    public function porMateria($id){
        $user = auth()->user()->id;
        $materia = Materia::where('user_id',$user)->paginate(25);
        $current = url()->current();
        $materia_id = Str::after($current, 'estudiantes/');
        $num_estudiantes = DB::table('estudiante_materia')->where('materia_id',$materia_id)->count();
        $estudiantes = Estudiante::where('user_id',$user)->get();
        return view('configurar.estudiantes.index', compact('estudiantes','materia','id','materia_id','num_estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $current = url()->current();
        $materia_id = Str::after($current, 'estudiantes/');
        return view('configurar.estudiantes.create', compact('materia_id'));
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

        $materia_id = request('create_materia_id');
        $user_id = request('user_id');
        $cadena = request('lista_completa');
        $cuantos = 1;
        $nuevos = 1;
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
            // la materia que cursa 
            $materia = Materia::find($materia_id);
            // comprobamos si el estudiante ya está registrado
            $busca_estudiante = DB::table('estudiantes')->where('user_id',$user_id)->where('nombre_completo',$nombre_completo)->first();
            // si no está registrado
            if($busca_estudiante == null){
                // insertamos los datos del estudiante obteniendo su id 
                $estudiante_id = DB::table('estudiantes')->insertGetId(['nombre'=>$nombre,'apellidos'=>$apellidos,'nombre_completo'=>$nombre_completo,'user_id'=>$user_id]);
                // guardamos el registro en la tabla estudiante_materia
                $materia->estudiantes()->attach($estudiante_id);
                $nuevos++;
                $mns_nuevos = ' Hay '.$nuevos.' estudiantes nuevos.';
            // si está registrado
            }elseif($busca_estudiante !== null){
                // obtenemos el id del estudiante;
                $estudiante_id = DB::table('estudiantes')->where('user_id',$user_id)->where('nombre_completo',$nombre_completo)->value('id');
                $materia->estudiantes()->attach($estudiante_id);   
            }
            // Crear el mensaje informativo para el usuario y guardar el registro
            $mns_estudiantes ='Se han registrado '.$cuantos.' estudiantes en la materia.';
            // $estudiante->save();
            $cuantos++;
        }
        return redirect()->route('materias.index')->with('info', $mns_estudiantes.$mns_nuevos);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
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
        $current = url()->previous();
        $materia_id = Str::after($current, 'estudiantes/');
        return view('configurar.estudiantes.edit', compact( 'estudiante','materia_id'));
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
        $materia_id = request('materia_id');
        $user_id = request('user_id');
        if($request->validate([
            'nombre' =>'required',
            'apellidos' =>'required'
            ])
        )
        {   $estudiante = Estudiante::find($id);
            $nombre = request('nombre');
            $apellidos = request('apellidos');
            $estudiante->nombre = $nombre;
            $estudiante->apellidos = $apellidos;
            $estudiante->nombre_completo = $nombre." ".$apellidos;
            $estudiante->user_id = $user_id;
            $estudiante->save();
        }
        return redirect()->route('estudiantes.porMateria',$materia_id);   
    }

        //=========  COMPROBAR  BORRar por materias
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
        return redirect()->route('materias.index')->with('info', $mns_estudiante);
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
        return redirect()->route('materias.index')->with('info', $mns_grupo);
    }
}
