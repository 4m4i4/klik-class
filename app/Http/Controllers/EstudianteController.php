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
    public function index()
    {   
        $user = auth()->user()->id;
        $materia = Materia::where('user_id',$user)->get();
        $estudiante_materia = DB::table('estudiante_materia')->get();
        $estudiantes = Estudiante::where('user_id',$user)->with('materias')->paginate(25);

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
        // ){

        $materia_id = request('create_materia_id');
        $user_id = request('user_id');
        $cadena = request('lista_completa');
        $cuantos = 1;
        $nuevos = 1;
        $mns_nuevos='';
        // Si la cadena acaba en punto y coma, lo quitamos
        if(Str::endsWith($cadena,';')) 
            $cadena = Str::beforeLast($cadena,';');
        // obtenemos el array de estudiantes
        $arrApellidosNombre = Str::of($cadena)->explode(";");
        $num_estudiantes = count($arrApellidosNombre);

        // recorremos el array, asignamos nombre y apellidos (separados por coma) a las variables
        for ($i = 0; $i < $num_estudiantes; $i++) { 
            $estudiante = Str::of( $arrApellidosNombre[$i])->explode(",");
            $apellidos = $estudiante[0];
            $nombre = $estudiante[1];
            $apellidos = Str::of($apellidos)->ltrim();
            $nombre = Str::of($nombre)->ltrim();
            $nombre_completo = Str::of($nombre)->append(" ".$apellidos);
            // la materia que cursa 
            $materia = Materia::find($materia_id);
            // comprobamos si el estudiante ya está registrado
            $busca_estudiante = DB::table('estudiantes')->where('user_id',$user_id)->where('nombre_completo',$nombre_completo)->first();
            // si NO está registrado
            if($busca_estudiante == null){
                // insertamos los datos del estudiante obteniendo su id 
                $estudiante_id = DB::table('estudiantes')->insertGetId(['nombre'=>$nombre,'apellidos'=>$apellidos,'nombre_completo'=>$nombre_completo,'user_id'=>$user_id]);
                // guardamos el registro en la tabla estudiante_materia
                $materia->estudiantes()->attach($estudiante_id);
                $mns_nuevos = ' Hay '.$nuevos.' estudiantes nuevos.';
                $nuevos++;
            }
            // si SÍ está registrado
            elseif($busca_estudiante !== null){
                // obtenemos el id del estudiante;
                $estudiante_id = DB::table('estudiantes')->where('user_id',$user_id)->where('nombre_completo',$nombre_completo)->value('id');
                $materia->estudiantes()->attach($estudiante_id);   
            }
            // Creamos el mensaje informativo para el usuario y guardar el registro
            $mns_estudiantes ='Se han registrado '.$cuantos.' estudiantes en la materia.';
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
        $mns ='';
        $user_id = request('user_id');
        if($request->validate([
            'nombre' =>'required',
            'apellidos' =>'required'
            ])
        ){  $estudiante = Estudiante::find($id);
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
        $aula_id = $materia->aula_id;
        foreach ($materia->estudiantes as $estudiante)
            $estudiante->delete();
        DB::table('aulas')->where('id',$aula_id)
            ->update(['num_columnas'=>5,'num_filas'=>5,'num_mesas'=>25, 'check'=>0]);
        DB::table('mesas')->where('aula_id',$aula_id)
            ->delete();

        return redirect()->route('materias.index')->with('info', $mns_grupo);
    }




    // public function misEstudiantes(){
    //      if(Auth::check()){
    //         $user = Auth::user()->id;
    //         $materias = Materia::where('user_id',$user)->with('aula')->get();
    //         $estudiantes = Estudiante::where('user_id',$user)->with('mesa')->get();
    //         $estudiante_materia= DB::table('estudiante_materia')->get();
    //         // dd($materias);
    //         $num_materias= $materias->count();
    //         // dd($num_materias);   
    //         $materia = [];      
    //         $ids_estudiante = [];  
    //         $ids_materia = [];
    //         for($i= 0; $i < $num_materias; $i++){
    //             $materia = $materias[$i];
    //             $materia_id = $materia->id;

    //             // $estudiante_materia = DB::table('estudiante_materia')->where('materia_id',$materia_id)->get();
    //             foreach($materia->estudiantes as $estudiante){
    //                 $estudiante_id = $estudiante->pivot->estudiante_id;
    //                 $estudiantes = Estudiante::where('user_id',$user)->find( $estudiante_id)->get();
    //                 array_push( $ids_estudiante, $estudiantes);
    //             }
    //             array_push( $ids_materia,  $materia, $ids_estudiante);
    //         }
    //         return response()->json(['success' => true, 'ids_materia'=>$ids_materia ], 200);
    //     }
    // }


    public function misEstudiantes(){
         if(Auth::check()){
            $user = Auth::user()->id;
            $materias = Materia::where('user_id',$user)->with('aula')->get();
            $estudiantes = Estudiante::where('user_id',$user)->with('mesa')->get();
            $estudiante_materia= DB::table('estudiante_materia')->get();
            // dd($materias);
            $num_materias= $materias->count();
            // dd($num_materias);
            $id_estaMateria = [];
                
            $ids_estudiante = [];  
            $ids_materia = []; 
            $lista_materias = [];
            array('estudiantes por materia'=>array('materias'=>$ids_materia,'estudiantes'=>$ids_estudiante)); 
            for($i= 0; $i < $num_materias; $i++){
                $materia = $materias[$i];
                $materia_id = $materia->id;
                array_push($ids_materia,$materia_id);
            }
            for($i= 0; $i < $num_materias; $i++){
                $materia_id = $ids_materia[$i];
                $estudiante_materia = DB::table('estudiante_materia')->where('materia_id',$materia_id)->get();
                $num_estudiantes = $estudiante_materia->count();
                foreach($estudiante_materia as $estudiante){
                    $estudiante_id = $estudiante->estudiante_id;
                    array_push($ids_estudiante,$estudiante_id );
                }
                $lista_materias[$i]=array('estudiantes por materia'=>array('materia'=>$ids_materia[$i]),array('estudiantes'=>$ids_estudiante));
                unset($ids_estudiante);
                 $ids_estudiante = [];
            }
        }

        return response()->json(['success' => true, 'lista_materias'=>$lista_materias ], 200);
    }

    public function estudianteMateriasMesa(){
        $user_id = auth()->user()->id;
        $materia = Materia::where('user_id',$user_id)->get();
        $estudiante = DB::table('estudiantes')
                // ->crossJoin('materias')
                // ->get();
            ->join('materias','estudiante.id','=','materias.estudiante_id')
            ->join('mesas','estudiante.id','=','mesas.estudiante_id')
            ->select('estudiantes.*','materias.materia_name','mesas.columna','mesas.fila','mesas.aula_id')
            ->get();

        return response()->header('Content-Type','application/json')->json(['success' => true, 'estudiante' => $estudiante], 200); 
    }




}
