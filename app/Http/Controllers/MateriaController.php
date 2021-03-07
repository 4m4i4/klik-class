<?php

namespace App\Http\Controllers;
use App\Models\Materia;
use App\Models\Aula;
use App\Models\Clase;
use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Support\Str;
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
            $aulas = Aula::get();
            $materias = Materia::where('user_id',$user)->with('user')->paginate(12);
        return view('configurar.materias.index', compact('materias','aulas'));
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
                'materia_name' =>'required|regex:/^[a-zA-Z]{3,16}\s\d[a-zA-Z]{1,3}\s[a-zA-Z]{3,10}/|unique:materias'
                ])
            )
        {   

            // Identificamos al usuario
            $user = auth()->user()->id;
            // obtenemos el nombre de la materia y lo ponemos en mayúscula
            $new_name = Str::of(request('materia_name'))->upper();
            // obtenemos el nombre del grupo (lo que va tras el primer espacio)
            $grupo =  Str::after($new_name," ");
            // Creamos una nueva materia y le asignamos las propiedades
            $materia = new Materia([
                'materia_name'=>$new_name,
                'grupo'=>$grupo,  
                'user_id'=>request('user_id')
                ]);
            //Componemos el mensaje para el usuario y guardamos la materia
            $msn_materia = 'Se ha añadido la materia';
            $materia->save();

            $msn_aula = '';
            // comprobamos que el usuario no ha registrado un aula con ese nombre en la tabla aulas, 
            $busco_aula = DB::table('aulas')->where('user_id',$user)
                                            ->where('aula_name',$grupo)
                                            ->first();

            // si no existe creamos un aula nueva con ese nombre y añadimos el mensaje para el usuario
            if($busco_aula == ''||$busco_aula == NULL){
                $aula = new Aula([
                'aula_name'=>$grupo,
                'user_id'=>request('user_id')
                ]);
                $aula->save();  
                $aula->refresh();
                $msn_aula= ' y el aula';
            }

            return redirect()->route('materias.index')->with('success', $msn_materia.$msn_aula);
        }
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
        return redirect()->route('materias.index')->with('success', $mns_materias.$mns_aulas); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Materia $materia)
    {
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
                'materia_name' =>'required|regex:/^[a-zA-Z]{3,16}\s\d[a-zA-Z]{1,3}\s[a-zA-Z]{3,10}/|unique:materias'
                ])
            )
        {
            
            // Identificamos al usuario
            $user = auth()->user()->id;
            // obtenermos el nombre de la materia que se va a sustituir entre las materias de ese usuario            
            // $materias = Materia::where('user_id', $user)->get();
            $old_name = $materia->materia_name;            
            // obtenemos el nombre del grupo
            $old_grupo = $materia->grupo;
            // dd( $old_grupo.' '.$old_name);

            // obtenemos el nuevo nombre de materia y lo ponemos en mayúscula
            $new_name = Str::of(request('materia_name'))->upper();
            // obtenemos el nuevo nombre de grupo
            $new_grupo =  Str::after($new_name," ");
            // dd( $new_grupo.' '.$new_name);

            $mns_aulas ='';
            $b_aula = Aula::where('user_id', $user)->where('aula_name', $new_grupo)->first();

                //  SUSTITUIR aula: si existe solo una materia con el nombre del grupo viejo, y no hay ningun aula con el nombre del grupo nuevo. 
                //  creamos un mensaje para informar al usuario de que se ha actualizado el aula
                if( DB::table('materias')->where('user_id', $user)->where('grupo', $old_grupo)->count() == 1 && $b_aula == NULL ){
                    // obtenemos la id del aula vieja
                    $aula = Aula::where('user_id', $user)->where('aula_name', $old_grupo)->get();
                    $id = $aula[0]->id;
                    // actualizamos el nombre
                    DB::table('aulas')->where('id', $id)->update(['aula_name'=>$new_grupo]);

                    $mns_aulas = 'El aula '.$old_grupo.' es ahora '.$new_grupo.';<br> ';
                }

                // CREAR aula: si no existe un aula con el nombre del grupo nuevo; 
                // creamos un mensaje para informar al usuario de que se ha creado
                $b_aula = DB::table('aulas')->where('user_id', $user)->where('aula_name',$new_grupo)->first();
                if($b_aula == NULL ){
                    $aula = Aula::where('user_id',$user)->get();
                    $aula = new Aula([
                        'aula_name'=>$new_grupo,
                        'user_id'=>request('user_id')
                    ]);
                    $aula->save();
                    $aula->refresh();
                    $mns_aulas =' Se ha creado el aula '.$new_grupo.'; ';
                }

            // si el registro existe lo actualiza, si no existe lo crea
            // DB::table('aulas')->updateOrInsert(
            //     ['aula_name'=>$old_grupo,'user_id'=>$user],['aula_name'=>$new_grupo,'user_id'=>$user]);
 
            // actualizamos y guardamos el registro de materia
            $materia->materia_name = $new_name;
            $materia->grupo = $new_grupo;
            $materia->user_id = request('user_id');  
            $materia->save();

            //  BORRAR aula: si ya no existe una materia con el nombre de grupo viejo pero existe un aula con ese nombre.
            $b_materias = DB::table('materias')->where('user_id', $user)->where('grupo', $old_grupo)->exists();
            // dd($b_materias);
                if(!$b_materias && DB::table('aulas')->where('user_id', $user)->where('aula_name', $old_grupo)->count() == 1){
                    $aula = Aula::where('user_id', $user)->where('aula_name', $old_grupo)->get();
                    $id = $aula[0]->id;
                    // dd($id);
                    DB::table('aulas')->where('id',$id)->delete();
                }           
            return redirect()->route('materias.index')->with('success',  $mns_aulas.' La materia '.$old_name.' se ha actualizado a '.$new_name);
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
        if($num==1){
            DB::table('aulas')->where('user_id', $user)->where('aula_name',$grupo)->delete();
            $mns_aulas= 'y aula';
        }

        $materia->delete();
        return redirect()->route('materias.index')->with('success', 'Se ha borrado materia '.$mns_aulas);
    }

}
