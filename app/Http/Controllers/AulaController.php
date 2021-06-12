<?php

namespace App\Http\Controllers;
use App\Models\Aula;
use App\Models\Clase;
use App\Models\Mesa;
use App\Models\Materia;
use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;       
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
            $clase = Clase::select('materia_id')->get();
            $estudiantes = Estudiante::select('id')->get();
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
                'check' =>'required|boolean'
                // 'num_estudiante' =>'nullable',
            ])
        )
        {
            $aula = new Aula([
               'aula_name'=>request('aula_name'),
               'num_columnas'=>request('num_columnas'),
               'num_filas'=>request('num_filas'),
               'num_mesas'=>request('num_mesas'),
               'user_id'=>request('user_id'),
               'check'=>request('check')
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

        $aula_hasMesas = $mesas->where('user_id', $user)->where('aula_id',$aula->id)->first();
        $materia = DB::table('materias')->where('user_id',$user)->where('grupo',$aula->aula_name)->first();
        $materia_id = $materia->id;
        $estudiantes = Materia::find($materia_id)->estudiantes()->get();
        $n_student = $estudiantes->count();
        $materia_name = DB::table('materias')->where('user_id',$user)->where('aula_id',$aula->id)->value('materia_name');
        // dd( $materia_name);
        $index = 0;
        $mesasIndex = [];
        $contador = 0;
        // Si el aula no tiene mesas las ponemos
        if($aula_hasMesas == null){
            for ($row = $aula->num_filas;  $row > 0; $row--){
              for ($col = 1; $col <= $aula->num_columnas; $col++){
                  $mesa = new Mesa;

                  $mesa->columna = $col;
                  $mesa->fila = $row;
                  $mesa->aula_id = $aula->id;
                  $mesa->user_id = $user;
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
            
            $vaciarMesa = Mesa::where('user_id', $user)->where('aula_id',$aula->id)->get();
            $firstMesa = $vaciarMesa[0]->id;
            $lastMesa = $firstMesa + $vaciarMesa->count() -1;   
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
            for($i = $firstMesa; $i <= $lastMesa; $i++){
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
        return view('configurar.aulas.show', compact('aula', 'user','mesas', 'estudiantes','materia_name'));
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
        $materia = DB::table('materias')->where('user_id',$user)->where('grupo',$aula->aula_name)->first();
        $materia_id = $materia->id;
        $num_estudiantes = Materia::find($materia_id)->estudiantes()->count();
        return view('configurar.aulas.edit', compact('aula','num_estudiantes'));
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
        $user = Auth::user()->id;
        // obtener los valores anteriores de columnas y filas
        $old_num_columnas = intVal($aula->num_columnas);
        $old_num_filas = intVal($aula->num_filas);
        $old_num_mesas = $aula->num_mesas;
        $mesas_aula = Mesa::where('user_id',$user)->where('aula_id', $aula->id)->get();
        //   dd($mesas_aula);
        $miAula = Aula::where('id', $aula->id)->with('mesas')->get();
        // dd($miAula);

        $nombreAula = request('aula_name');
        $columnas = request('num_columnas');
        $filas = request('num_filas');
        $mesas = request('num_mesas');
        $maxMesas = $columnas * $filas;
        $num_estudiantes = request('num_estudiantes');
        $msn ='Parece que has olvidado introducir el grupo de estudiantes de ' .$nombreAula;
        $columnas= intVal($columnas);
        $filas = intVal($filas);
        if($mesas_aula->count() > 0){
        // si hay cambios en el número de columnas y filas, actualiza los campos columna y fila de las mesas
            if(!($columnas === $old_num_columnas)||!($filas === $old_num_filas)){
                $indice= 0;
                for ($row = $filas;  $row > 0; $row--){
                    for ($col = 1; $col <= $columnas; $col++){
                        if($mesas_aula->count() < $indice){
                            $id = $mesas_aula[$indice]->id;
                            DB::table('mesas')->where('id', $id)->update(['columna'=>$col,'fila'=>$row]);
                        }
                        $indice++;
                    }
                }
            }
            
            $msn_maxMesas = 'Has puesto '.intval($mesas - $maxMesas) .' mesas más que las que caben en '.$columnas .' columnas x '.$filas. ' filas';

            if($mesas > $maxMesas) return redirect()->route('materias.index')->with('info', $msn_maxMesas);
        }
        if($request->validate([
                'aula_name' =>'required|string',
                'num_columnas' =>'required|integer|max:9|min:1',
                'num_filas' =>'required|integer|max:9|min:1',
                'num_mesas' =>'required|integer|max:'.$maxMesas,
                'check' =>'required|boolean'

             ])
        )
        {
            $aula->aula_name = request('aula_name');
            $aula->num_columnas = request('num_columnas');
            $aula->num_filas = request('num_filas');
            $aula->num_mesas = request('num_mesas');
            $aula->user_id = request('user_id');
            $aula->check = request('check');
            $aula->save();
            $aula->refresh();
            if($num_estudiantes == '0') return redirect()->route('materias.index')->with('info', $msn);
            else
            return redirect()->route('materias.index')->with('info', 'El aula '.$nombreAula.' se ha actualizado con éxito. Pulsa ver para sentar a los estudiantes');
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
        $aula->delete();
        return redirect()->route('aulas.index')->with('info', 'Aula borrada');
    }


    public function editMesasVacias(Aula $aula)
    {
        // hace falta validar los datos, si no en caso de fallo hay resultdos inesperados: guardar solo un cambio y duplicar un estudiante --> la siguiente será un fallo de offset
        $user = Auth::user()->id;
        // declaramos la variable para guardar los id de los estudiantes
        $ids_estudiante =[];  
        // obtenemos la materia que corresponde al aula
        $materia = Materia::where('user_id',$user)->where('grupo', $aula->aula_name)->first();
        $materia_name = DB::table('materias')->where('user_id',$user)->where('aula_id',$aula->id)->value('materia_name');
        // Recorremos la materia guardando los ids de los estudiantes en un array 
        foreach($materia->estudiantes as $estudiante){
            array_push( $ids_estudiante, $estudiante->pivot->estudiante_id);
        }
        // $estudiantes = Estudiante::where('user_id',$user)->get();
        // $mesas = Mesa::where('user_id',$user)->where('aula_id',$aula->id)->get();
        $vacias = Mesa::where('aula_id',$aula->id)->where('is_ocupada',0)->get('id');
        return view('configurar.vacias', compact('aula', 'ids_estudiante','vacias','materia_name'));
    }


    public function updateMesasVacias(Request $request, Aula $aula)
    {
        $user = Auth::user()->id;
        $mesas = Mesa::where('aula_id',$aula->id)->where('is_ocupada',1)->get();
        $vacias = Mesa::where('aula_id',$aula->id)->where('is_ocupada',0)->get();
        $ids_mesas = []; // ids de las mesas ocupadas
        $ids_estudiante =[];  // ids de los estudiantes que hay en el aula
        $estudiantePosicion = []; // ids de los estudiantes de esa materia

        // obtener y guardar ids mesas ocupadas y id estudiantes
        foreach  ($mesas as $mesa) {
            array_push( $ids_mesas, $mesa->id);
            array_push( $ids_estudiante, $mesa->estudiante_id);
        }

        $materia = Materia::where('user_id', $user)
                    ->where('grupo', $aula->aula_name)
                    ->first();
        $materia_name = DB::table('materias')->where('user_id',$user)->where('aula_id',$aula->id)->value('materia_name');
        $estudiantes = $materia->estudiantes;// dd($estudiantes);
        $n_student = $estudiantes->count();// dd($n_student);

        $cambiarVacias = request('cambiarMesasVacias');
        // si se van a cambiar las mesas vacías
        if(!$cambiarVacias == null){
            $arr_mesasVacias= Str::of($cambiarVacias)->explode(",");// dd($arrLevantar);
            $num_mesasVacias = count($arr_mesasVacias) ;
            for($i = 0; $i < $num_mesasVacias; $i++){
                $mesaColRow = $arr_mesasVacias[$i];
                $columna =  Str::before($mesaColRow, '_');// dd($columna);
                $fila = Str::after($mesaColRow, '_'); // dd($fila);
                // obtener la id de la mesa a vaciar
                $id_vaciar = DB::table('mesas')
                            // ->where('mesa_name',$aula->id.'_'.$mesaColRow)
                            ->where('aula_id', $aula->id)
                            ->where('columna',$columna)
                            ->where('fila',$fila)
                            ->value('id');// dd($id_vaciar);
                // vaciar la mesa 
                $vaciarMesa = Mesa::find( $id_vaciar);
                $vaciarMesa->is_ocupada = false;
                $vaciarMesa->estudiante_id = null;
                $vaciarMesa->save();
                $vaciarMesa->refresh();
            }

            foreach ($vacias as $vacia){
                $vacia->is_ocupada = true;
                $vacia->save();
                $vacia->refresh();
            }   
            for($i = 0; $i < $n_student; $i++){
                array_push( $estudiantePosicion, $estudiantes[$i]->id);
            }
            $newOcupadas = Mesa::where('aula_id', $aula->id)
                            ->where('is_ocupada',1)
                            ->get();
            $i = 0;
            foreach ($newOcupadas as $mesa){
                $id = $mesa->id;
                DB::table('mesas')
                    ->where('id', $id)
                    ->update(['estudiante_id'=> $estudiantePosicion[$i]]);
                $i++;
            }
        }
        $sentar = request('sentarEstudiantes');
        // Cambiar estudiantes de mesas
        if(!$sentar == null){
            $arrSentar = Str::of($sentar)->explode(",");
            $num_sentar = count($arrSentar) ;


            for($i = 0; $i < $num_sentar; $i++){
                $num_index= intVal($arrSentar[$i])-1;
                $estudiantePosicion[$i] = $ids_estudiante[$num_index];
            }

            for($i = 0; $i < $num_sentar; $i++){
                $vaciarMesa = Mesa::find( $ids_mesas[$i]);
                $vaciarMesa->estudiante_id = $estudiantePosicion[$i];
                $vaciarMesa->save();
            }
        }
        return redirect()->route('aulas.show', compact('aula','materia_name'));
    }
}