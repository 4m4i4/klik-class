<?php

namespace App\Http\Controllers;
use App\Models\Aula;
use App\Models\Clase;
use App\Models\Mesa;
use App\Models\Materia;
use App\Models\Estudiante;
use App\Models\User;
        use Illuminate\Support\Arr;   use Illuminate\Support\Str;       
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
            $user = auth()->user()->id; 
            // // versión A (el modelo Estudiante se importa en el index):
            // $aulas = Aula::where('user_id',$user)->with('user','clase','mesas')->get();

            // return view('configurar.aulas.index', compact('aulas'));

            // // versión B (El modelo Estudiante se importa aquí)
            $aulas = Aula::where('user_id',$user)->get();
            $clase = Clase::select('aula_id', 'materia_id')->get();
            $estudiantes = Estudiante::select('id','materia_id')->get();
            return view('configurar.aulas.index', compact('aulas', 'clase', 'estudiantes'));

            // // versión C (El modelo Estudiante se importa aquí)
            // $aulas = Aula::where('user_id',$user)->with('user','clase','mesas')->get();
            // $estudiantes = Estudiante::select('id','materia_id')->get();
            // return view('configurar.aulas.index', compact('aulas', 'estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configurar.aulas.create');
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
                'aula_name' =>'required|string',
                'num_columnas' =>'required|integer|max:9|min:1',
                'num_filas' =>'required|integer|max:9|min:1',
                'num_mesas' =>'required|integer|max:30',
                // 'num_estudiante' =>'nullable',
            ])
        )
        {
            $aula = new Aula([
               'aula_name'=>request('aula_name'),
               'num_columnas'=>request('num_columnas'),
               'num_filas'=>request('num_filas'),
               'num_mesas'=>request('num_mesas'),
               'user_id'=>request('user_id')
            ]);
            $aula->save();
            return redirect()->route('materias.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Aula $aula)
    {   
        $user = Auth::user()->id;
        $mesas = Mesa::all();
        $hasMesas = $aula->mesas;
        $aula_hasMesas = $mesas->where('aula_id',$aula->id)->first();
        $materia = Materia::where('user_id', $user)->where('grupo', $aula->aula_name)->first();
        $index = 0;
        $mesasIndex = [];
        $studentIndex=[];
        $estudiantes = $materia->estudiantes;
        // dd($estudiantes);
        $n_student = $estudiantes->count();
        $contador = 0;
        // Si el aula no tiene mesas las ponemos
        if($aula_hasMesas == null){
            for ($i = $aula->num_filas;  $i > 0; $i--) {
              for ($ii = 1; $ii <= $aula->num_columnas; $ii++){
                  $mesa = new Mesa;
                  $mesa->columna = $ii;
                  $mesa->fila = $i;
                  $mesa->aula_id = $aula->id;
                  $mesa->clase_id = $aula->clase->id;
                  $mesa->is_ocupada = true;
                  if($index < $aula->num_mesas) {
                    $mesa->save();
                    $mesa->refresh();
                  }
                  $mesasIndex[$index] = $index;
                  $index++;
              }
            }
            $n_mesas = $aula->num_mesas;
            $dif = $n_mesas - $n_student;
              // dd($hasMesas);
            $estaMesa = Mesa::where('aula_id',$aula->id)->get();
            $firstMesa = $estaMesa[0]->id;
            $lastMesa = $firstMesa + $estaMesa->count();   
              // si hay mesas vacías
            if($dif > 0){
              $mesasIndex = Arr::shuffle($mesasIndex);
              $vacias = Arr::random($mesasIndex, $dif);
                // dd($mesasIndex);
              for ($ii = 0; $ii < count($vacias); $ii++){
                $indice = $vacias[$ii] + $firstMesa;
                // asignar null a estudiante_id en las mesas vacías 
                DB::table('mesas')->where('id',$indice)->update(['is_ocupada'=>false]);
              }  
            }
            for($i = $firstMesa; $i < $lastMesa; $i++){
                $mesa_id = Mesa::find($i);
                if($mesa_id->is_ocupada == true  && $contador < $estudiantes->count()){
                    $mesa_id->is_ocupada = true;
                    $mesa_id->estudiante_id = $estudiantes[$contador]->id;
                    $mesa_id->save();
                    $mesa_id->refresh();
                    $contador++;
                } 
            } 
        }

        // $aula = Aula::where('user_id',$user)->find($id);
        return view('configurar.aulas.show', compact('aula', 'user','mesas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Aula $aula)
    {
        $user = Auth::user()->id;
        $clase = Clase::select('aula_id', 'materia_id')->get();
        $estudiantes = Estudiante::select('id','materia_id')->get();
        // return view('configurar.aulas.edit', compact('aula','clase','estudiantes'));
        // $clase = Clase::where('user_id', $user)->where('aula_id', $aula)->value('materia_id');
        // dd($clase);
// $estudiantes = Estudiante::get();
// foreach($estudiantes as $ikasle)
// echo $ikasle->materia_id.' ';
// $materia = Materia::find($clase);
// $materia = Materia::get();
// $countStudents = $materia->estudiantes->count();
// $countStudents = $materia->where('id',$materia_id)estudiantes()->count();

// dd($clase,$estudiantes);
        // $estudiantes = Estudiante::select('id','materia_id')->get();
        return view('configurar.aulas.edit', compact('aula','clase','estudiantes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aula $aula)
    {
        $nombreAula= request('aula_name');
        $columnas=request('num_columnas');
        $filas=request('num_filas');
        $mesas=request('num_mesas');
        $num_estudiantes = request('num_estudiantes');
        $maxMesas = $columnas * $filas;
        $msn_maxMesas ='Has puesto '.intval($mesas - $maxMesas) .' mesas más que las que caben en '.$columnas .' columnas x '.$filas. ' filas';
        $msn='Parece que has olvidado introducir el grupo de estudiantes de ' .$nombreAula;
        // if($mesas>$maxMesas)return redirect()->route('aulas.index')->with('success', $msn_maxMesas);
        
        if($request->validate([
                'aula_name' =>'required|string',
                'num_columnas' =>'required|integer|max:9|min:1',
                'num_filas' =>'required|integer|max:9|min:1',
                'num_mesas' =>'required|integer|max:'.$maxMesas,
                // 'num_estudiante' =>'required|integer|min:1',
             ])
        )
        {
            $aula->aula_name = request('aula_name');
            $aula->num_columnas = request('num_columnas');
            $aula->num_filas = request('num_filas');
            $aula->num_mesas = request('num_mesas');
            $aula->user_id = request('user_id');
            $aula->save();
            $aula->refresh();
            if($num_estudiantes == '0')return redirect()->route('aulas.index')->with('success', $msn);
            return redirect()->route('materias.index');
            // return redirect()->route('aulas.show',$aula->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aula $aula)
    {
        // $aula = Aula::find($id);
        $aula->delete();
        return redirect()->route('aulas.index')->with('success', 'Aula borrada');
    }


    public function editMesasVacias(Aula $aula)
    {
        $user = Auth::user()->id;
        $clase = Clase::where('user_id',$user)->where('aula_id', $aula->id)->value('materia_id');
        $materia = Materia::where('id',$clase)->value('materia_name');
        $estudiantes = Estudiante::where('materia_id',$clase)->get(['nombre','apellidos','id']);
        $mesas = Mesa::where('aula_id',$aula->id)->where('is_ocupada',1)->get(['id','estudiante_id']);
        $vacias = Mesa::where('aula_id',$aula->id)->where('is_ocupada',0)->get('id');
        return view('configurar.vacias', compact('aula', 'user','clase','materia','estudiantes','mesas','vacias'));
    }


    public function updateMesasVacias(Request $request, Aula $aula)
    {
        $user = Auth::user()->id;
        $mesas = Mesa::where('aula_id',$aula->id)->where('is_ocupada',1)->get();
        $vacias = Mesa::where('aula_id',$aula->id)->where('is_ocupada',0)->get();        
        
        $ids_mesas = []; // ids de las mesas ocupadas
        $ids_estudiante =[];  // ids de los estudiantes que hay en el aula
        $estudiantePosition = [];
        // obtener y guardar ids mesas ocupadas y id estudiantes
        foreach  ($mesas as $mesa) {
            array_push( $ids_mesas, $mesa->id);
            array_push( $ids_estudiante, $mesa->estudiante_id);
        }
        $clase = Clase::where('user_id',$user)->where('aula_id', $aula->id)->value('materia_id');

        $materia = Materia::where('user_id', $user)->where('grupo', $aula->aula_name)->first();
        $estudiantes = $materia->estudiantes;
        // dd($estudiantes);
        $n_student = $estudiantes->count();
        // dd($n_student);

        $sentar = request('sentarEstudiantes');
        $cambiarVacias = request('levantarEstudiantes');
        // si se van a cambiar las mesas vacías
        if(!$cambiarVacias == null){
            $arrLevantar= Str::of($cambiarVacias)->explode(";");
            $num_mesas_levantar = count($arrLevantar) ;
            $ids_mesas = [];  // 
            // dd($arrLevantar);
            // $new_vacias = [];

            for($i = 0; $i < $num_mesas_levantar; $i++){
                $arrColRow = $arrLevantar[$i];
                $arrMesa = Str::of($arrColRow)->explode(",");
                $columna =  Str::before( $arrColRow, ',');
                $fila = Str::after( $arrColRow, ',');                
                // dd($columna);
                // dd($fila);
                $id_vaciar = DB::table('mesas')->where('aula_id', $aula->id)->where('columna',$columna)->where('fila',$fila)->value('id');
                // dd($id_vaciar);
                $estaMesa =  Mesa::find( $id_vaciar);
                $estaMesa->is_ocupada = false;
                $estaMesa->estudiante_id = null;
                $estaMesa->save();
                $estaMesa->refresh();
                // DB::table('mesas')->where('id', $id_vaciar)->update(['is_ocupada'=>false,'estudiante_id',null]);
            }

            foreach ($vacias as $vacia){
                $vacia->is_ocupada = true;
                
                $vacia->save();
                $vacia->refresh();
            }   
            for($i = 0; $i < $n_student; $i++){
                $estudiantePosition[$i] = $ids_estudiante[$i];
            }
            $newOcupadas =  Mesa::where('aula_id',$aula->id)->where('is_ocupada',1)->get();
            $iii = 1;
            foreach ($newOcupadas as $mesa){
                $mesa->estudiante_id = $estudiantePosition[$i];
                $mesa->save();
                $mesa->refresh();
                $iii++;
            }
            // for($i = 0; $i < $n_student; $i++){
            //     $estaMesa =  Mesa::where('aula_id',$aula->id)->where('is_ocupada',1)->get();
            //     $estaMesa->estudiante_id = $estudiantePosition[$i];
            //     $estaMesa->save();
            //     $estaMesa->refresh();

            // }

            // $estasMesas = Mesa::where('aula_id', $aula->id)->get();
            
            // foreach ($estasMesas as $mesa) {
            //     array_push( $ids_mesas, $mesa->id);
            //     // DB::table('mesas')->where('id', $mesa->id)->update(['is_ocupada'=>false,'estudiante_id'=>null]);
            // }

            // dd($new_vacias);
            // for($i = 0; $i < $num_levantar; $i++){
            //     $estaMesa =  Mesa::find( $num_levantar[$i]);
            //     $estaMesa->is_ocupada=true;
            //     $estaMesa->save();
            // }  
        }
        
        if(!$sentar == null){
            $arrSentar = Str::of($sentar)->explode(",");
            $num_sentar = count($arrSentar) ;


            for($i = 0; $i < $num_sentar; $i++){
                $estudiantePosition[$i] = $ids_estudiante[$arrSentar[$i] -1];
            }

            for($i = 0; $i < $num_sentar; $i++){
                $estaMesa =  Mesa::find( $ids_mesas[$i]);
                $estaMesa->estudiante_id = $estudiantePosition[$i];
                $estaMesa->save();
            }
        }
    
        return redirect()->route('aulas.show', compact('aula'));
    }
}
