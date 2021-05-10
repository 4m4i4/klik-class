<?php

namespace App\Http\Controllers;
use App\Models\Materia;
use App\Models\Aula;
use App\Models\Sesion;
use App\Models\Clase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ClaseController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $user = Auth::user()->id;
            $materias = Materia::where('user_id',$user)->get();
            $aulas= Aula::where('user_id',$user)->get();
            $clases = Clase::where('user_id',$user)->with('user','materia','aula','sesion')->get();
            return view('configurar.clases.index', compact('materias','aulas','clases'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user()->id;
        $materias = Materia::where('user_id',$user)->get();
        $aulas = Aula::where('user_id',$user)->get();
        return view('configurar.clases.create', compact('materias','aulas'));
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
                'sesion_id'=>'required',  
                'dia' =>'required',
                'user_id' => 'required',
                'materia_id'=>'required'
                // 'aula_id'=>'required',
            ])
         )
         {
            $materia = Materia::find(request('materia_id'));
            $aula_name = $materia->grupo;
            $aula_id = Aula::where('user_id',request('user_id'))->where('aula_name',$aula_name)->value('id');
             $clase = new Clase([
                'sesion_id'=>request('sesion_id'),
                'dia'=>request('dia'),
                'user_id'=>request('user_id'),
                'materia_id'=>request('materia_id'),
                'aula_id'=>$aula_id
             ]);
             $clase->save();
             return redirect()->route('clases.index')->with('info', 'Clase añadida');
         }
    }

    public function mostrarClase()
    {
        $user = auth()->user()->id;
        $dias =[ "Domingo",
                 "Lunes",
                 "Martes",
                 "Miercoles",
                 "Jueves",
                 "Viernes",
                 "Sabado"
                ];
                // https://www.php.net/manual/en/ev.examples.php
        $h = now();
        $now = Carbon::now();
        $date = date_create("$now");
        $diaSemana = $dias[date("w")];
        // // $diaSemana= 'Lunes';
        // $hora = date("H");
        // // dd($hora);
        // $minutos = date("i");
        // // dd($minutos);
        // $aula = Aula::get();
        // $materia = Materia::get();
        // $sesion = Sesion::get();
        $clases = Clase::where('user_id',$user)
                       ->select('dia','sesion_id','aula_id','materia_id')
                       ->where('dia', $diaSemana )
                       ->with('sesion','materia')
                       ->get();

        // $ahora = '08:31:00';
        $dateTimeAhora = date_create($h);
        $ahora = $dateTimeAhora->format("H:i:s");
       
        echo '<br>'.$now.'<br>';
        echo 'Día: '.$diaSemana.'<br><br>';
        // $hayClase = '<br><strong>No tienes clase</strong>';

        // BUCLE FOR
        // $clasesCount = $clases->count();
        // for($i = 0; $i < $clasesCount; $i++){

        //     // CONDICIÓN
        //     if($clases[$i]->sesion->inicio <= $ahora && $clases[$i]->sesion->fin >= $ahora){
        //         // FIN de CONDICIÓN
        //         $hayClase = '<strong>Hay clase</strong>';
        //         echo '<br>'. $hayClase.'<br>';
        //         $laMateria = $clases[$i]->materia->materia_name;
        //         $elAula = $clases[$i]->aula->aula_name;
        //         $elInicio = $clases[$i]->sesion->inicio;
        //         $elFin = $clases[$i]->sesion->fin;
        //         echo   '<br> Materia: '.$laMateria.
        //                '<br> Aula: '.$elAula.
        //                '<br>Inicio: '.$elInicio.
        //                '<br>Fin: '. $elFin;

        //         //   // TIEMPO PASADO DE CLASE Y TIEMPO QUE QUEDA DE CLASE

        //         $dateTimeIni = date_create($elInicio);
        //         $dateTimeFin = date_create($elFin);
            
        //         // echo '<br><br> Son las '.$now->roundMinute()->format('H:m'); 
        //         $intervaloPasado = $dateTimeAhora->diff($dateTimeIni);
        //         $intervaloFuturo = $dateTimeFin->diff($dateTimeAhora);
        //         echo '<br><br>';
        //         echo '<br>'.$intervaloPasado->format("%H:%I:%S").'- Tiempo transcurrido';
        //         echo '<br>'.$intervaloFuturo->format("%H:%I:%S").'- Tiempo restante' ;
        //     }
        //     else echo $hayClase;
        // }



        // BUCLE FOREACH 

        foreach($clases as $clase){
                $laMateria = $clase->materia->materia_name;
                $elAula = $clase->aula->aula_name;
                $elInicio = $clase->sesion->inicio;
                $elFin = $clase->sesion->fin;
            
            if($elInicio <= $ahora && $elFin >= $ahora){

                $hayClase = '<strong>Hay clase</strong>';
                echo '<br>'. $hayClase.'<br>';

                echo   '<br> Materia: '.$laMateria.
                       '<br> Aula: '.$elAula.
                       '<br>Inicio: '.$elInicio.
                       '<br>Fin: '. $elFin;

                 //   // TIEMPO PASADO DE CLASE Y TIEMPO QUE QUEDA DE CLASE

                $dateTimeIni = date_create($elInicio);
                $dateTimeFin = date_create($elFin);
            
                // echo '<br><br> Son las '.$now->roundMinute()->format('H:m'); 
                $intervaloPasado = $dateTimeAhora->diff($dateTimeIni);
                $intervaloFuturo = $dateTimeFin->diff($dateTimeAhora);
                echo '<br><br>';
                echo '<br>'.$intervaloPasado->format("%H:%I:%S").'- Tiempo transcurrido';
                echo '<br>'.$intervaloFuturo->format("%H:%I:%S").'- Tiempo restante' ;
            }
            else $hayClase =  '<br><strong>No tienes clase</strong>';
        }

        //  return response()->json($clases)->header('Content-Type','application/json');

    }
    public function clasesPorDia()
    {
        $user = auth()->user()->id;
        $clases = Clase::where('user_id',$user)
            ->select('dia','id','sesion_id','aula_id','materia_id')
            // ->where('dia', $diaSemana )
            ->with('sesion','materia','aula','mesas')
            ->orderBy('dia')
            ->get();
        return response()->json($clases)->header('Content-Type','application/json');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Clase $clase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Clase $clase)
    {
        $user = Auth::user()->id;
        $materias = Materia::where('user_id', $user)->get();
        $aulas = Aula::where('user_id', $user)->get();
        
        return view('configurar.clases.edit', compact('clase', 'materias','aulas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clase $clase)
    {
        if($request->validate([
                'dia' =>'required',
                'sesion_id'=>'required',
                'user_id' => 'required',
                'materia_id'=>'required'
           ])
         )
         {
            $clase->dia = request('dia');
            $clase->sesion_id = request('sesion_id');
            $clase->user_id = request('user_id');
            $clase->materia_id = request('materia_id');

            $materia = Materia::find(request('materia_id'));
            $aula_name = $materia->grupo;
            $aula_id = Aula::where('user_id',request('user_id'))->where('aula_name',$aula_name)->value('id');
            $clase->aula_id = $aula_id;
            $clase->save();            
            return redirect()->route('clases.index')->with('info', 'Clase actualizada');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clase $clase)
    {
        // $clase = Clase::find($id);
        $clase->delete();
        return redirect()->route('clases.index')->with('info', 'Clase borrada');
    }
}