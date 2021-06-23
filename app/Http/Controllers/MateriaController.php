<?php

namespace App\Http\Controllers;
use App\Models\Materia;
use App\Models\Aula;
use App\Models\Mesa;
use App\Models\Clase;
use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class MateriaController extends Controller
{
    use AuthenticatesUsers;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()

    {  
        if(Auth::check()){
            $user = Auth::user()->id; 
            $materias = Materia::where('user_id',$user)->with('user','estudiantes','aula','clases')->paginate(12);
        return view('configurar.materias.index', compact('materias','user'));
        }
    }


    public function misMaterias(){
        if(Auth::check()){
            $user = Auth::user()->id;
            // $materias = Materia::where('user_id',$user)->with('user','estudiantes','aula','clases')->get();
            $materias = Materia::where('user_id',$user)->with('estudiantes.mesa')->get();
            // return response()->json(['success' => true, 'materias' => $materias], 200);
            return response()->header('Content-Type','application/json')->json(['success' => true, 'materias' => $materias], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('configurar.materias.create');
    }

    /**
     * Show the form for creating all the resources.
     *
     * @return \Illuminate\Http\Response
     */

    public function createall()
    {
        return view('configurar.materias.createall');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {   // si pasa la validación... no funciona en el formulario modal
        
        if($request->validate([
           
            //     'materia_name' =>'required|regex:/^\D{3,20}\s\d[a-zA-Z]{1,3}\s[a-zA-Z]{3,10}/|unique:materias'
               'materia_name' =>'required|regex:/^[a-z\-_áéíóú]{3,20}\s\d[a-zA-Z]{1,3}\s[a-zA-Z]{3,10}/|unique:materias'
            //    'materia_name' =>'required|regex:/^[a-z\-_]{3,20}\s\d[a-zA-Z]{1,3}\s[a-zA-Z]{3,10}/|unique:materias'
                ])
            )
        {   
            // Identificamos al usuario
            $user = auth()->user()->id;
            // obtenemos el nombre de la materia y lo ponemos en mayúscula
            $new_name = Str::of(request('materia_name'))->upper();
            // obtenemos el nombre del grupo (lo que va tras el primer espacio)
            $grupo =  Str::after($new_name," ");
            $msn_aula = '';
            // comprobamos que el usuario no ha registrado un aula con ese nombre en la tabla aulas, 
            $busco_aula = DB::table('aulas')->where('user_id',$user)
                                            ->where('aula_name',$grupo)
                                            ->first();
            // si no existe creamos un aula nueva con ese nombre y añadimos el mensaje para el usuario
            if($busco_aula == ''||$busco_aula == NULL){
                $aula_id = DB::table('aulas')->insertGetId(['aula_name'=>$grupo,'user_id'=>request('user_id')]);
                $msn_aula= ' y el aula '.$grupo;
            }
            elseif($busco_aula !== ''||$busco_aula !== NULL){
                $aula_id = $busco_aula->id;
            }
            // Creamos una nueva materia y le asignamos las propiedades
            $materia = new Materia([
                'materia_name'=>$new_name,
                'grupo'=>$grupo,
                'aula_id'=>$aula_id,
                'user_id'=>request('user_id')
                ]);
            //Componemos el mensaje para el usuario y guardamos la materia
            $msn_materia = 'Se ha añadido la materia '.$new_name;
            $materia->save();
        }
            return redirect()->route('materias.index')->with('info', $msn_materia.$msn_aula);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeall(Request $request)
    {   
        //Obtenemos la cadena de nombres separados por comas introducida por el usuario
        $cadena = request('createall');
        // comprobamos si la cadena acaba en coma, y si es así la quitamos
        // ya que daría error (el sistema busca una entrada que no existe)
        if(Str::endsWith($cadena,','))
            $cadena = Str::beforeLast($cadena,',');

        // obtenemos el array con los nombres de materia
        $arr = Str::of($cadena)->explode(",");
        // declaramos una variable para contar las aulas añadidas
        $num_aulas = 0;

        // recorremos el array de nombres de materia
        for ($i = 0; $i < count($arr); $i++) { 
            $registro = $arr[$i];
            // ponemos el nombre de materia en mayúscula
            $materia_name = Str::of($registro)->upper();
            // obtenemos el nombre del grupo (lo que va detrás del espacio)
            $grupo = Str::after($materia_name," ");

            // Creamos una nueva materia y le asignamos las propiedades
            $materia = new Materia([
                'materia_name'=>$materia_name,
                'grupo'=>$grupo,
                'user_id'=>request('user_id')
            ]);
            // escribimos el mensaje del usuario con el número de materias
            // y guardamos el registro
            $mns_materias ='Se han añadido '.((int)$i+1) . ' materias';
            $materia->save();

            $mns_aulas = '';
            // buscamos si el usuario ha añadido ese nombre de aula en la tabla aulas
            $b_aula = DB::table('aulas')
                        ->where('aula_name',$grupo)
                        ->where('user_id',request('user_id'))->first();
            // creamos el aula nueva si no la ha añadido
            if($b_aula==''||$b_aula ==NULL){
                $aula = new Aula([
                    'aula_name'=>$grupo,
                    'user_id'=>request('user_id')
                ]);
                // sumamos 1 en la cuenta de aulas y escribimos el mensaje
                $num_aulas = $num_aulas + 1;
                $mns_aulas =' y '.$num_aulas.' aulas';
                $aula->save();
                $aula->refresh();
            }
        }
        return redirect()->route('materias.index')->with('info', $mns_materias.$mns_aulas); 
    }


    public function laMateria($id)
    {  
        $materia = Materia::find($id);
        $aula_id = $materia->aula_id;
        $laMateria = Materia::where('id',$id)->with('estudiantes.mesa')->get();
        $elAula = Aula::where('id',$aula_id)->with('mesas')->get();
        
        return response()->header('Content-Type','application/json')->json(['success' => true, 'laMateria' => $laMateria, 'elAula'=>$elAula], 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Materia $materia)
    {
        // Identificamos al usuario
        $user = auth()->user()->id;
        return view('configurar.materias.edit', compact( 'materia', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Materia $materia)
    {
        if($request->validate([
                // 'materia_name' =>'required|regex:/^\D{3,20}\s\d[a-zA-Z]{1,3}\s[a-zA-Z]{3,10}/|unique:materias'
                'materia_name' =>'required|regex:/^[a-z\-_áéíóú]{3,20}\s\d[a-zA-Z]{1,3}\s[a-zA-Z]{3,10}/|unique:materias'
                ])
            )
        {
            // Identificamos al usuario
            $user = auth()->user()->id;
            // obtenermos el nombre de la materia que se va a sustituir entre las materias de ese usuario            
            $old_name = $materia->materia_name;            
            // obtenemos el nombre del grupo
            $old_grupo = $materia->grupo;
            // obtenemos el id del aula asociada
            $old_aula_id = $materia->aula_id;
            // dd( $old_grupo.' '.$old_name);

            // obtenemos el nuevo nombre de materia y lo ponemos en mayúscula
            $new_name = Str::of(request('materia_name'))->upper();
            // obtenemos el nuevo nombre de grupo
            $new_grupo =  Str::after($new_name," ");
            // dd( $new_grupo.' '.$new_name);

            $mns_aulas ='';
            // chequeamos si existe un aula con el nombre que se ha editado
            $b_aula = DB::table('aulas')->where('user_id', $user)->where('aula_name',$new_grupo)->first();
            if($b_aula !== NULL){
                $aula_id = $b_aula->id;
                $mns_aulas = 'El aula '.$old_grupo.' es ahora '.$new_grupo.';';
            }

                //  SUSTITUIR aula: si existe solo una materia con el nombre del grupo viejo, y no hay ningun aula con el nombre del grupo nuevo. 
                //  creamos un mensaje para informar al usuario de que se ha actualizado el aula
                elseif( DB::table('materias')->where('user_id', $user)->where('grupo', $old_grupo)->count() == 1 && $b_aula == NULL ){
                    // // asignamos la id del aula vieja
                    $aula_id = $old_aula_id;
                    // actualizamos el nombre en el aula vieja
                    DB::table('aulas')->where('id', $aula_id)->update(['aula_name'=>$new_grupo]);
                    $mns_aulas = 'El aula '.$old_grupo.' es ahora '.$new_grupo.';';
                }

                // CREAR aula: si no existe un aula con el nombre del grupo nuevo; 
                // creamos un mensaje para informar al usuario de que se ha creado
                elseif($b_aula == NULL ){
                    $aula_id = DB::table('aulas')->insertGetId(['aula_name'=>$new_grupo,'user_id'=>request('user_id')]);
                    $mns_aulas =' Se ha creado el aula '.$new_grupo.'; ';
                }

            // si el registro existe lo actualiza, si no existe lo crea
            // DB::table('aulas')->updateOrInsert(
            //     ['aula_name'=>$old_grupo,'user_id'=>$user],['aula_name'=>$new_grupo,'user_id'=>$user]);
 
            // actualizamos y guardamos el registro de materia
            $materia->materia_name = $new_name;
            $materia->grupo = $new_grupo;
            $materia->user_id = request('user_id');
            $materia->aula_id = $aula_id;
            $materia->save();

            //  BORRAR aula: si ya no existe una materia con el nombre de grupo viejo pero existe un aula con ese nombre.
            $b_materias = DB::table('materias')->where('user_id', $user)->where('grupo', $old_grupo)->exists();
                if(!$b_materias && DB::table('aulas')->where('user_id', $user)->where('aula_name', $old_grupo)->count() == 1){
                    $aula = Aula::where('user_id', $user)->where('aula_name', $old_grupo)->first();
                    $id = $aula->id;
                    DB::table('aulas')->where('id',$id)->delete();
                }           
            return redirect()->route('materias.index')->with('info',  $mns_aulas.' La materia '.$old_name.' se ha actualizado a '.$new_name);
        }
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Materia $materia)
    {
        // Identificamos al usuario
        $user = auth()->user()->id;
        // $materia = Materia::find($id);
        $grupo = $materia->grupo;
        $num = Materia::all()->where('user_id', $user)->where('grupo',$grupo)->count();
        $mns_aulas ='';
        if($num == 1){
            DB::table('aulas')->where('user_id', $user)->where('aula_name',$grupo)->delete();
            $mns_aulas= 'y el aula '.$grupo;
        }

        $materia->delete();
        return redirect()->route('materias.index')->with('info', 'Se ha borrado la materia '.$materia->materia_name.' '.$mns_aulas);
    }

    public function checker($id){
        $check = true;

        $materia = Materia::find($id);
        $checkMateria = $materia->check;
        $check = $check && $checkMateria;

        $aula_id = $materia->aula_id;
        $aula = Aula::find($aula_id);
        $checkAula = $aula->check;
        $check = $check && $checkAula;

        foreach($materia->estudiantes as $estudiante){
            $estudiante_id = $estudiante->pivot->estudiante_id;
            $estudiante = Estudiante::find($estudiante_id);
            $checkEstudiante = $estudiante->check;
            $check = $check && $checkEstudiante;
        }

        return $check;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
     {  
        $user = Auth::user()->id;
        // $mesas = Mesa::all();
        $materia = Materia::find($id);
        $check = $materia->check;
        $materia_name = $materia->materia_name;
        $aula_id = $materia->aula_id;
        $aula = Aula::find($aula_id);
        $check = $check && $aula->check;
        // carga las mesas del aula
        $mesasDelAula = Mesa::where('user_id', $user)->where('aula_id',$aula->id)->get();
        // carga los ids de los estudiantes de la materia
        $estudiantes = Materia::find($id)->estudiantes()->pluck('estudiante_id');
        $lista_estudiantes = count($estudiantes) -1;

        foreach($materia->estudiantes as $estudiante){
            $estudiante_id = $estudiante->pivot->estudiante_id;
            $estudiante = Estudiante::find($estudiante_id);
            // dd($estudiante);
            $checkEstudiante = $estudiante->check;
            $check = $check && $checkEstudiante;
        }
        // si check es falso
        if( !$check ){
            foreach($mesasDelAula as $mesas){
                if($lista_estudiantes >= 0 && $mesas->is_ocupada == 0){
                    $mesa_id = $mesas->id;
                    $mesa = DB::table('mesas')->where('id', $mesas->id)->update(['estudiante_id'=>$estudiantes[$lista_estudiantes], 'is_ocupada'=>1]);
                    $estudiante = DB::table('estudiantes')->where('id',$estudiantes[$lista_estudiantes])->update(['check'=> 1]);
                    $lista_estudiantes--;
                }
            }
        }

        return view('configurar.materias.show', compact('materia','aula', 'user', 'estudiantes','materia_name'));
    }
    


    public function editMesasVacias($id)
    {

        $user = Auth::user()->id;
        $mesas = Mesa::all();
        $materia = Materia::find($id);
        $materia_name = $materia->materia_name;
        $aula_id = $materia->aula_id;
        $aula = Aula::find($aula_id);
        $num_mesas = $aula->num_mesas;
        $ids_estudiantes = [];
        $estudiantes = Materia::find($id)->estudiantes()->pluck('estudiante_id');
        $mesasDelAula = Mesa::where('aula_id',$aula->id)->pluck('id');
        $lista_mesas= count($mesasDelAula);
        //  contar los estudiantes del aula, guardar sus ids, y actualizar 'check' = 0
        for($i = $lista_mesas; $i > 0; $i--){
          $estaMesa = Mesa::find( $mesasDelAula[$i -1 ]);
        //   $estaMesa->is_ocupada = 0;
        //   $estaMesa->save();
          if(!$estaMesa->estudiante_id == null){
            $id_estudiante = $estaMesa->estudiante_id;
            DB::table('estudiantes')->where('id',$id_estudiante)->update(['check'=>0]);
            $ids_estudiantes[$i] = $id_estudiante;}
        }
        $total_estudiantes = count($ids_estudiantes);
        // dd($ids_estudiantes);
        // dd($total_estudiantes);        
        // // dd($mesasDelAula);
        // // dd($ids_estudiantes);
        // $estudiantes = Materia::find($id)->estudiantes()->pluck('estudiante_id');
        // $num_estudiantes = count($estudiantes) -1;
        // // $mat_x_aula = DB::table('materias')->where('aula_id',$aula->id)->pluck('id');
        // $mat_x_aula = DB::table('materias')->where('aula_id',$aula->id)->pluck('id');



        // for($i = count($mat_x_aula) ; $i > 0; $i--)
        //     $total_estudiantes  =  $total_estudiantes + Materia::find($mat_x_aula[$i -1] )->estudiantes()->count();
        
        return view('configurar.vacias', compact('aula','materia','materia_name', 'mesasDelAula','estudiantes','ids_estudiantes', 'total_estudiantes'));
    }


    //     // hace falta validar los datos, si no en caso de fallo hay resultdos inesperados: guardar solo un cambio y duplicar un estudiante --> la siguiente será un fallo de offset
    //     $user = Auth::user()->id;
    //     $materia = Materia::find($id);
    //     // declaramos la variable para guardar los id de los estudiantes
    //     $ids_estudiante =[];  
    //     // obtenemos la materia que corresponde al aula
       
    //     $materia_name = $materia->materia_name;
    //     $aula_id = $materia->aula_id;
    //     $aula = Aula::find($aula_id);
    //     // Recorremos la materia guardando los ids de los estudiantes en un array 
    //     foreach($materia->estudiantes as $estudiante){
    //         array_push( $ids_estudiante, $estudiante->pivot->estudiante_id);
    //     }

    //     $vacias = Mesa::where('aula_id',$aula_id)->where('is_ocupada',0)->get('id');
    //     return view('configurar.vacias', compact('aula','materia', 'mesasDelAula','materia_name'));
    // }


    public function updateMesasVacias(Request $request, $id)
    {
        // $user = Auth::user()->id;
        // $materia = Materia::find($id);
        // $aula_id = $materia->aula_id;
        // $mesas = Mesa::where('aula_id',$aula_id)->where('is_ocupada',1)->get();
        // $vacias = Mesa::where('aula_id',$aula_id)->where('is_ocupada',0)->get();
        // $ids_mesas = []; // ids de las mesas ocupadas
        // $ids_estudiante =[];  // ids de los estudiantes que hay en el aula
        // $estudiantePosicion = []; // ids de los estudiantes de esa materia

        // // obtener y guardar ids mesas ocupadas y id estudiantes
        // foreach  ($mesas as $mesa) {
        //     array_push( $ids_mesas, $mesa->id);
        //     array_push( $ids_estudiante, $mesa->estudiante_id);
        // }
        // $id = $materia->id;


        // $materia_name = $materia->materia_name;
        // $estudiantes = $materia->estudiantes;// dd($estudiantes);
        // $n_student = $estudiantes->count();// dd($n_student);

        // $cambiarVacias = request('cambiarMesasVacias');
        // // si se van a cambiar las mesas vacías
        // if(!$cambiarVacias == null){
        //     $arr_mesasVacias= Str::of($cambiarVacias)->explode(",");// dd($arrLevantar);
        //     $num_mesasVacias = count($arr_mesasVacias) ;
        //     for($i = 0; $i < $num_mesasVacias; $i++){
        //         $mesaColRow = $arr_mesasVacias[$i];
        //         $columna =  Str::before($mesaColRow, '_');// dd($columna);
        //         $fila = Str::after($mesaColRow, '_'); // dd($fila);
        //         // obtener la id de la mesa a vaciar
        //         $id_vaciar = DB::table('mesas')
        //                     ->where('aula_id', $aula_id)
        //                     ->where('columna',$columna)
        //                     ->where('fila',$fila)
        //                     ->value('id');// dd($id_vaciar);
        //         // vaciar la mesa 
        //         $vaciarMesa = Mesa::find( $id_vaciar);
        //         $vaciarMesa->is_ocupada = false;
        //         $vaciarMesa->estudiante_id = null;
        //         $vaciarMesa->save();
        //         $vaciarMesa->refresh();
        //     }

        //     foreach ($vacias as $vacia){
        //         $vacia->is_ocupada = true;
        //         $vacia->save();
        //         $vacia->refresh();
        //     }   
        //     for($i = 0; $i < $n_student; $i++){
        //         array_push( $estudiantePosicion, $estudiantes[$i]->id);
        //     }
        //     $newOcupadas = Mesa::where('aula_id', $aula_id)
        //                     ->where('is_ocupada',1)
        //                     ->get();
        //     $i = 1;
        //     foreach ($newOcupadas as $mesa){
        //         $id = $mesa->id;
        //         DB::table('mesas')
        //             ->where('id', $id)
        //             ->update(['estudiante_id'=> $estudiantePosicion[$i]]);
        //         $i++;
        //     }
        // }
        // $sentar = request('sentarEstudiantes');
        // // Cambiar estudiantes de mesas
        // if(!$sentar == null){
        //     $arrSentar = Str::of($sentar)->explode(",");
        //     $num_sentar = count($arrSentar) ;


        //     for($i = 0; $i < $num_sentar; $i++){
        //         $num_index= intVal($arrSentar[$i])-1;
        //         $estudiantePosicion[$i] = $ids_estudiante[$num_index];
        //     }

        //     for($i = 0; $i < $num_sentar; $i++){
        //         $vaciarMesa = Mesa::find( $ids_mesas[$i]);
        //         $vaciarMesa->estudiante_id = $estudiantePosicion[$i];
        //         $vaciarMesa->save();
        //     }
        // }

        $user = Auth::user()->id;
        $mesas = Mesa::all();
        $materia = Materia::find($id);
        $materia_name = $materia->materia_name;
        $aula_id = $materia->aula_id;
        $aula = Aula::find($aula_id);
        $num_mesas = $aula->num_mesas;
        $ids_estudiantes = [];
        $mesasDelAula = Mesa::where('aula_id',$aula->id)->pluck('id');
        $num_total= count($mesasDelAula);
        for($i = $num_total; $i > 0; $i--){
          $estaMesa = Mesa::find( $mesasDelAula[$i -1 ]);
          $ids_estudiantes[$i]= $estaMesa->estudiante_id; 
        }
        $total_estudiantes = count($ids_estudiantes);
        // foreach ($mesasDelAula as $mesa){
        //     DB::table('mesas')->where('id',$mesa->id)->update(['is_ocupada'=>0]);
        // }
        $sentar = request('sentarEstudiantes');
        $arrSentar = Str::of($sentar)->explode(",");
        $num_sentar = count($arrSentar) ;
        dd($num_sentar);
        foreach($sentar as $newSentar){

        }



        return redirect()->route('materias.show', compact('id', 'materia'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showMesasMateria($id) {
        $user = auth()->user()->id;
        $mesas = Mesa::all();
        $materia = Materia::find($id);
        $aula_id = $materia->aula_id;
        $materia_id = $materia->id;
        $materia_name = $materia->materia_name;
        $aula = Aula::find($aula_id);
        $mesasDelAula = $mesas->where('user_id', $user)->where('aula_id',$aula_id)->values('id');
        $estudiantes = Materia::find($materia_id)->estudiantes()->get();
        $num_student = $estudiantes->count();
        $estudiante_ids = [];
        $is_tinMat =[];
        $index_mesas = [];
        $index_estudiantes = [];
        $m=[];

        for($i = 0; $i < $num_student; $i++)   {
            array_push($estudiante_ids,$estudiantes[$i]->id);
        }
        foreach($mesasDelAula as $estaMesa){
            $id_estudiante = $estaMesa->estudiante_id;
            $mesa_id = $estaMesa->id;
            array_push($index_estudiantes, $id_estudiante);
            array_push($index_mesas, $mesa_id);
        }
        $cursandoMateria = array_intersect($index_estudiantes, $estudiante_ids);
        foreach($index_estudiantes as $matriculado){
            if(in_array($matriculado,$estudiante_ids)){
                array_push($m, $matriculado);
            }
        }

        return response()->json(['success' => true, 'estudiante_ids' => $estudiante_ids, 'index_mesas'=>$index_mesas,'index_estudiantes'=>$index_estudiantes, 'm'=>$m], 200);
    }



}
