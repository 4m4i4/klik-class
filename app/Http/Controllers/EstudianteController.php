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

    public function index($materia_id=null)
    {   
        $user = auth()->user()->id;
        // $num_materias = Materia::where('user_id',$user)->count();
        // $materia = Materia::find($materia_id);
        
        $materia = Materia::where('user_id',$user)->get();
        // $estudiantes = Estudiante::where('user_id',$user)->get();
        $estudiante_materia = DB::table('estudiante_materia')->get();
        $estudiantes = Estudiante::where('user_id',$user)->with('materias')->paginate(25);

        // $num_estudiantes = DB::table('estudiante_materia')->where('materia_id',$materia_id)->count();
       
        // return view('configurar.estudiantes.index', compact('materia','materias','estudiantes','num_estudiantes','user','materia_id','estudiante_materia'));
        return view('configurar.estudiantes.index', compact('materia','estudiante_materia','estudiantes','user'));
    }

    public function porMateria($materia_id){
        $user = auth()->user()->id;
        $current = url()->current();
        $materia_id = Str::after($current, 'estudiantes/');
        $materia = Materia::find($materia_id);
        $materias = Materia::where('user_id',$user)->get();
        $num_estudiantes = DB::table('estudiante_materia')->where('materia_id',$materia_id)->count();
        $estudiantes = Estudiante::where('user_id',$user)->with('materias')->get();
        return view('configurar.estudiantes.index', compact('estudiantes','materia','materias','materia_id','num_estudiantes'));
    }
    
    public function misEstudiantes(){
         if(Auth::check()){
            $user = Auth::user()->id;
            $estudiantes = Estudiante::where('user_id',$user)->with('user','materias','clases','mesa')->get();
            return response()->json(['success' => true, 'estudiantes' => $estudiantes], 200);
        }
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
        $materia = Materia::all();
        return view('configurar.estudiantes.create', compact('materia_id','materia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, Materia $id)
    {
        // TO-DO: validación de lista de estudiantes
        // if($request->validate([
        //    'lista_completa' =>'required|regex: /^([\w+ ]*\w+(,).+(;).+)/',
        //    'user_id'=>'required',
        //    'check' =>'required|boolean',
        //    'materia_id' => 'required'
        // ])
        // )
        // {
        $materia_id = request('create_materia_id');
        // dd($materia_id);
        $user_id = request('user_id');
        $cadena = request('lista_completa');
        $check = request('check');
        $cuantos = 1;
        $nuevos = 1;
        $mns_nuevos='';
        // Si la cadena acaba en punto y coma, lo quitamos
        if(Str::endsWith($cadena,';')) $cadena = Str::beforeLast($cadena,';');

        // obtenemos el array de estudiantes
        $arrApellidosNombre = Str::of($cadena)->explode(";");
        $num_estudiantes = count($arrApellidosNombre);

        // recorrer el array, asignar nombre y apellidos (separados por coma) a las variables
        for ($i = 0; $i < $num_estudiantes; $i++) { 
            $estudiante = Str::of( $arrApellidosNombre[$i])->explode(",");
            $apellidos = $estudiante[0];
            $nombre = $estudiante[1];
            // $nombre = Str::of($estudiante[1]);
            $nombre_completo = $nombre." ".$apellidos;
            // la materia que cursa 
            $materia = Materia::find($materia_id);
            // comprobamos si el estudiante ya está registrado
            $busca_estudiante = DB::table('estudiantes')->where('user_id',$user_id)->where('nombre_completo',$nombre_completo)->first();
            // si no está registrado
            if($busca_estudiante == null){
                // insertamos los datos del estudiante obteniendo su id 
                $estudiante_id = DB::table('estudiantes')->insertGetId(['nombre'=>$nombre,'apellidos'=>$apellidos,'nombre_completo'=>$nombre_completo,'user_id'=>$user_id,'check'=>$check]);
                // dd($estudiante_id);
                // guardamos el registro en la tabla estudiante_materia
                
                $materia->estudiantes()->attach($estudiante_id);
                // $estudiante_materia = DB::table('estudiante_materia')->insert(['materia_id'=>$materia_id, 'estudiante_id'=>$estudiante_id]);
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
        //}
        // else{
        //     $msn="Formatodfjahfd";
        //                 return back()->withInput()->withErrors(['lista_completa'=>$msn]);
            
        // }
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
        $mns ='';
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
            $mns='Los datos de '.$nombre." ".$apellidos.' se han actualizado con éxito' ;
        }
        return redirect()->route('estudiantes.porMateria',$materia_id)->with('info', $mns);   
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
        $materia = Materia::find($materia_id);
        $estudiantes = DB::table('estudiante_materia')->where('materia_id',$materia_id)->get();
        // $estudiantes = Estudiante::where('materia_id',$materia_id)->get();
        foreach ($materia->estudiantes as $estudiante)
        $estudiante->delete();
        return redirect()->route('materias.index')->with('info', $mns_grupo);
    }
}
