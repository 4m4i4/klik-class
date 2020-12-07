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

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $materias = Materia::get();
        $aulas = Aula::get();
        return view('configurar.materias.index', compact('materias','aulas'));
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
    {   // si pasa la validación... no funciona er el formulario modadl
        if($request->validate([
                'materia_name' =>'required|unique:materias|string',
                ])
            )
        {   
            // separamos el input: materia_name espacio cursoLetra espacio etapa
            $arr = Str::of(request('materia_name'))->explode(" ");
            $grupo = $arr[1]." ".$arr[2]; 
            $grupo = Str::of($grupo)->upper();
            $materia = new Materia([
                'materia_name'=>Str::of(request('materia_name'))->upper(), 
                'grupo'=>$grupo  // se usa para alimentar la tabla Aula
                ]);

            $msn_materia= 'Se ha añadido la materia';
            $materia->save();

            $msn_aula='';
            // compruebo que el grupo no existe en la tabla Aula, 
            $busco_aula = DB::table('aulas')->where('aula_name',$grupo)->first();
            // dump($busco_aula);

            if($busco_aula==''||$busco_aula ==NULL){
                    $aula = new Aula([      //y añado el aula
                    'aula_name'=>$grupo
                    ]);
                    $aula->save();  
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
                'grupo'=>$grupo
            ]);
            $mns_materias ='Se han añadido todas las Materias';
            $materia->save();

            $mns_aulas='';
            $b_aula = DB::table('aulas')->where('aula_name',$grupo)->first();

            // dump($busco_aula);

            if($b_aula==''||$b_aula ==NULL){
                $aula = new Aula([
                    'aula_name'=>$grupo
                    ]);
                $mns_aulas =' y aulas';
                $aula->save();  
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
            }
            elseif($num>1){
                $aula = new Aula([
                    'aula_name'=>Str::of($grupo)->upper()
                    ]);
                $mns_aulas =' Se ha creado un aula nueva; ';
                $aula->save();  
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
 public function paso(Request $request, User $user)
//  public function paso(User $user)
    {   
        $user = auth()->user();
        $paso = $user->paso; 
        // $user->paso = request('paso');
        $user->paso = $paso;
        $user->save();

        if($user->paso == 1) {
            $mensaje = "paso 1";
             return redirect( url()->previous())->with('success', $mensaje. " ..... pasitos de Gesmar");
        }
        elseif($user->paso > 1) {$mensaje = "paso 2";
 return redirect()->route('home/paso', compact('user'))->with('success', $mensaje. "...Pasooooo, pasitos de Gesmar");}

               
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
