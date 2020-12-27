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
            //  dd($user);
            // $aulas = Aula::get();
            $aulas = Aula::get();
            // dd($aulas);
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
            // separamos el input: materia_name espacio cursoLetra espacio etapa
            // para componer $grupo que se usa como nombre del aula en la tabla aulas
            $arr = Str::of(request('materia_name'))->explode(" ");
            $grupo = $arr[1]." ".$arr[2]; 
            $grupo = Str::of($grupo)->upper();
            $materia = new Materia([
                'materia_name'=>Str::of(request('materia_name'))->upper(), 
                'grupo'=>$grupo,  
                'user_id'=>request('user_id')
                ]);

            $msn_materia= 'Se ha añadido la materia';
            $materia->save();

            $msn_aula='';
            // compruebo que el grupo no existe en la tabla Aula, 
            $busco_aula = DB::table('aulas')->where('aula_name',$grupo)->first();
            // dump($busco_aula);
            // si no está la añadimos
            if($busco_aula==''||$busco_aula ==NULL){
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
            $cadena = request('createall');
            if(Str::endsWith($cadena,','))
            $cadena=Str::beforeLast($cadena,',');
            $arr = Str::of($cadena)->explode(",");

            for ($i=0; $i <count($arr); $i++) { 
            $registro = $arr[$i];
            
                $materia_name = Str::of($registro)->upper();
                $fila = Str::of($materia_name)->explode(" ");
                $grupo =$fila[1]." ".$fila[2];


                $materia = new Materia([
                    'materia_name'=>$materia_name,
                    'grupo'=>$grupo,
                    'user_id'=>request('user_id')
                ]);
                $mns_materias ='Se han añadido todas las Materias';
                $materia->save();

                $mns_aulas='';
                $b_aula = DB::table('aulas')->where('aula_name',$grupo)->first();

                // dump($busco_aula);

                if($b_aula==''||$b_aula ==NULL){
                    $aula = new Aula([
                        'aula_name'=>$grupo,
                        'user_id'=>request('user_id')
                        ]);
                    $mns_aulas =' y aulas';
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
        $materia = Materia::find($id);
        return view('configurar.materias.edit', compact( 'materia'));
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
               'materia_name' =>'required|unique:materias|string',  
                ])
            )
        {
            $materia = Materia::find($id);
            $gr = $materia->grupo;
            // si hay un grupo; actualizar entrada de aula; si hay más, crear nueva entrada
            $num = Materia::all()->where('grupo',$gr)->count();
            $nuevo = request('materia_name');
            $grupo =  Str::after($nuevo," ");
            if($num == 1){
                $aula = Aula::where('aula_name',$gr)->first();
                $aula->aula_name = Str::of($grupo)->upper();
                $mns_aulas ='Aula actualizada; ';
                $aula->save();
                $aula->refresh();
            }
            elseif($num>1){
                $aula = new Aula([
                    'aula_name'=>Str::of($grupo)->upper()
                    ]);
                $mns_aulas =' Se ha creado un aula nueva; ';
                $aula->save();  
                $aula->refresh();
            }
            $materia->materia_name = request('materia_name');
            $arr = Str::of(request('materia_name'))->explode(" ");
            $grupo = $arr[1]." ".$arr[2];
            $grupo = Str::of($grupo)->upper();
            $materia->grupo = $grupo;
            $materia->materia_name = Str::of($nuevo)->upper();
            $materia->save();

            return redirect()->route('materias.index')->with('success',  $mns_aulas.' Materia actualizada');
        }
    }


    function queAula(Materia $materia){

        $nombre_grupo= $materia->grupo;
        $aulas = Aula::where('aula_name',$nombre_grupo)->get();
        $aula_id =$aulas->id;

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $materia = Materia::find($id);
        // dd($materia);
        // $aula = Aula::get();
        // $borrar=$aula->where('aula_name',$materia->grupo);
        // $AulaController.destroy($aula);
        // $borrar->delete();
        $materia->delete();
        
        return redirect()->route('materias.index')->with('success', 'Materia borrada');
    }

}
