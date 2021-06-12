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
            $sesiones= Sesion::where('user_id',$user)->get();
            $clases = Clase::where('user_id',$user)->with('user','materia','sesion')->get();
            return view('configurar.clases.index', compact('user','sesiones','materias','aulas','clases'));
        }
    }


    public function misClases(){
         if(Auth::check()){
            $user = Auth::user()->id;
            $aulas= Aula::where('user_id',$user)->get();
            $clases = Clase::where('user_id',$user)->with('user','materia','sesion')->get();
            return response()->json(['success' => true, 'clases' => $clases, 'aulas' => $aulas], 200);
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
            ])
         )
         {

            $clase = new Clase([
                'sesion_id'=>request('sesion_id'),
                'dia'=>request('dia'),
                'user_id'=>request('user_id'),
                'materia_id'=>request('materia_id')
             ]);
             $clase->save();
             return redirect()->route('clases.index')->with('info', 'Clase añadida');
         }
    }



    public function clasesPorDia()
    {
        $user = auth()->user()->id;
        $clases = Clase::where('user_id',$user)
            ->select('dia','id','sesion_id','materia_id')
            ->with('sesion','materia')
            // ->orderBy('dia')
            ->orderBy('dia')->orderBy('sesion_id')
            ->get();
        return response()->json($clases)->header('Content-Type','application/json');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Clase $clase) {}

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
        // $aulas = Aula::where('user_id', $user)->get();
        return view('configurar.clases.edit', compact('clase', 'materias'));
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
        $clase->delete();
        return redirect()->route('clases.index')->with('info', 'Clase borrada');
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

        $h = now();
        $now = Carbon::now();
        $date = date_create("$now");
        $diaSemana = $dias[date("w")];

        // https://www.php.net/manual/en/ev.examples.php       
            // $hora = date("H");
            // $minutos = date("i");
            // $aula = Aula::get();
            // $materia = Materia::get();
        // $sesion = Sesion::get();


        // // --------- FAKE DATA  --------------

        // $ahora = '2021-06-05 10:26:30';
        // $dateTimeAhora = date_create($ahora);
        // $diaSemana = 'Martes';
        // echo '<br>'.$ahora.'<br>';
        // echo 'Día: '.$diaSemana.'<br><br>';
        // $ahora = $dateTimeAhora->format("H:i");

        // // -------- fin de FAKE DATA --------


        $aClase = false;
        $clases = Clase::where('user_id',$user)
                       ->select('dia','sesion_id','materia_id')
                       ->where('dia', $diaSemana )
                       ->with('sesion','materia')
                       ->get();


        // --------- REALTIME DATA  --------------

        $dateTimeAhora = date_create($now);
        $ahora = $dateTimeAhora->format('H:i');
        $date = Carbon::now();
        // $ahora = $date->addHours(9);
        // $ahora = $date->subHours(15);
        $ahora = $date->format('h:i');
         $hoy = $now->format('d/m/Y');
        echo '<br>'.$hoy.'<br>'.$ahora.'<br>';
        echo $diaSemana.'<br><br>';

        // -------- fin de REALTIME DATA  ---------

  
        // BUCLE FOREACH 

        foreach($clases as $clase){
                $laMateria = $clase->materia->materia_name;
                $elAula = $clase->materia->grupo;
                $elAula_id = $clase->materia->aula_id;
                $elInicio = $clase->sesion->inicio;
                $elFin = $clase->sesion->fin;
            
            if($elInicio <= $ahora && $elFin >= $ahora){

                $hayClase = '<strong>Hay clase</strong>';
                $aClase = true;
                echo '<br>'. $hayClase.'<br>';

                echo 
                       '<br> Materia: '.$laMateria.
                       '<br> Aula: '.$elAula.
                       '<br> Aula ID'.$elAula_id.
                       '<br>Inicio: '.$elInicio.
                       '<br>Fin: '. $elFin;
                

                 //   // TIEMPO PASADO DE CLASE Y TIEMPO QUE QUEDA DE CLASE

                $dateTimeIni = date_create($elInicio);
                $dateTimeFin = date_create($elFin);
            
                // echo '<br><br> Son las '.$now->roundMinute()->format('H:m'); 
                $intervaloPasado = $dateTimeAhora->diff($dateTimeIni);
                $intervaloFuturo = $dateTimeFin->diff($dateTimeAhora);
                echo '<br><br>';
                echo '<br>'.$intervaloPasado->format("%H:%I").'- Tiempo transcurrido';
                echo '<br>'.$intervaloFuturo->format("%H:%I").'- Tiempo restante' ;

                // return [
                //     'laMateria' => $this->$laMateria,
                //     'elAula' => $this-> $elAula,
                //     'elAula_id' => $this-> $elAula_id,
                //     'elInicio' => $this-> $elInicio,
                //     'elFin' => $this-> $elFin,
                //     'aClase' => $this->$aClase,
                //     'intervaloPasado' =>$this->$intervaloPasado,
                //     'intervaloFuturo' =>$this->$intervaloFuturo,
                // ];
                // $datos = array(                    
                //     'ahora'=>$ahora,
                //     'hoy'=> $hoy,
                //     'diaSemana'=> $diaSemana
                // );
                // $datos = array(                    
                //     "ahora"=>$ahora,
                //     "hoy"=> $hoy,
                //     "diaSemana"=> $diaSemana,
                //     "laMateria"=>$laMateria,
                //     "elAula" => $elAula,
                //     "elAula_id" => $elAula_id,
                //     "elInicio" =>  $elInicio,
                //     "elFin" =>  $elFin,
                //     "aClase" => $aClase
                // );
                //    return  response()->json([
                //     'ahora' =>$ahora,
                //     'hoy' => $hoy,
                //     'diaSemana' => $diaSemana]);
                //     ,
                //     "laMateria" =>$laMateria,
                //     "elAula" => $elAula,
                //     "elAula_id" => $elAula_id,
                //     "elInicio" =>  $elInicio,
                //     "elFin" =>  $elFin,
                //     "aClase" => $aClase,
                //     "dateTimeIni" => $dateTimeIni,
                    
                //     "dateTimeFin" => $dateTimeFin,
                //     "dateTimeAhora" => $dateTimeAhora,
                //     "intervaloPasado" =>$intervaloPasado,
                //     "intervaloFuturo" =>$intervaloFuturo
                //    ]);

            //  return response()->json($datos)->header('Content-Type','application/json');
            return redirect()->route('aulas.show',$elAula_id);
            //  return route('aulas.show',$elAula_id);
            }
        }
        if($aClase==false) echo '<br><strong>No tienes clase</strong>';
        //  return response()->json($clases)->header('Content-Type','application/json');
    }


}