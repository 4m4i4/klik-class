<?php

namespace App\Http\Controllers;
use App\Models\Materia;
use App\Models\Aula;
use App\Models\Sesion;
use App\Models\Clase;
use App\Models\User;
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
                'materia_id'=>'required',
                'aula_id'=>'required',
            ])
         )
         {
             $clase = new Clase([
                'sesion_id'=>request('sesion_id'),                
                'dia'=>request('dia'),
                'user_id'=>request('user_id'),
                'materia_id'=>request('materia_id'),
                'aula_id'=>request('aula_id')
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

        // $h= now();
        // $date = date_create("$h");
        // $diaSemana = $dias[date("w")];
        // $hora= date('H');
        // $minutos=date('i');
        // $aula=Aula::get();
        // $materia=Materia::get();
        // $sesion=Sesion::get();
        // $clases = Clase::where('user_id',$user)
        //                ->select('dia','sesion_id','aula_id','materia_id')
        //                ->where('dia',$diaSemana )
        //                ->with('sesion','materia')
        //                ->get();
        // $cuenta=$clases->count();

        // $ahora='08:31:00';
        // echo 'Día: '.$diaSemana.'<br>';
        // echo 'Hora: '.$ahora.'<br>';
        // echo '<script>';

        // echo '</script>';
        // BUCLE FOR

        // for($i=0; $i<$cuenta; $i++){

        // // CONDICIÓN
        //   if($clases[$i]->sesion->inicio<=$ahora && 
        //     $clases[$i]->sesion->fin>=$ahora){
        // // FIN de CONDICIÓN
            
        //     $laMateria=$clases[$i]->materia->materia_name;
        //     $elAula=$clases[$i]->aula->aula_name;
        //     echo '<br>A las '.$clases[$i]->sesion->inicio.
        //            ' empieza '.$laMateria.
        //            ' en el aula '.$elAula.
        //            ', y termina a las '. $clases[$i]->sesion->fin;

        // // CONDICIÓN
        // }        
        // else echo '<br>nada que mostrar';
        // }
        // // FIN de CONDICIÓN


        // BUCLE FOREACH 

        // foreach($clases as $clase){

            // // CONDICIÓN
            // if($clase->sesion->inicio<=$ahora && 
            // $clase->sesion->fin>=$ahora){
            // // FIN de CONDICIÓN

                // $laMateria=$clase->materia->materia_name;
                // $elAula=$clase->aula->aula_name;
                // echo'<br>A las '.$clase->sesion->inicio.
                //     ' empieza '.$laMateria.
                //     ' en el aula '.$elAula.
                //     ', y termina a las '. $clase->sesion->fin;

            // // CONDICIÓN
            // }
            // else echo '<br>nada que mostrar';
            // // FIN de CONDICIÓN
        // }
        

        // EL PRIMERO DE LA COLECCIÓN

    //     if($clases[0]->sesion->inicio<=$ahora && 
    //        $clases[0]->sesion->fin>=$ahora){
            
    //         $laMateria=$clases[0]->materia->materia_name;
    //         $elAula=$clases[0]->aula->aula_name;
           
    //         echo '<br><br>El primero de la colección
    //                 <br> A las '.$clases[0]->sesion->inicio.
    //                ' empieza '.$laMateria.
    //                ' en el aula '.$elAula.
    //                ', y termina a las '. $clases[0]->sesion->fin;

    //         // TIEMPO PASADO DE CLASE Y TIEMPO QUE QUEDA DE CLASE

    //         $dateTimeIni=date_create($clases[0]->sesion->inicio);
    //         $dateTimeFin=date_create($clases[0]->sesion->fin);
    //         $dateTimeAhora=date_create($ahora);
    //         $intervaloPasado=$dateTimeAhora->diff($dateTimeIni);
    //         $intervaloFuturo=$dateTimeFin->diff($dateTimeAhora);
    //         echo "<br><br> TIEMPO PASADO DE CLASE Y TIEMPO QUE QUEDA DE CLASE";
    //         echo '<br>- El tiempo de clase transcurrido es '.$intervaloPasado->format("%H:%I:%S");
    //         echo '<br>- El tiempo que queda de clase es '.$intervaloFuturo->format("%H:%I:%S");
    //     }
        
    //     else echo '<br>nada que mostrar';
    // // return $clases; // muestra un objeto json

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $materias = Materia::where('user_id',$user)->get();
        $aulas = Aula::where('user_id',$user)->get();
        $clase = Clase::where('user_id',$user)->get();
        
        return view('configurar.clases.edit', compact('clase','materias','aulas'));
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
                'materia_id'=>'required',
                'aula_id'=>'required',
            ])
         )
         {
            // $clase = Clase::find($id);
            $clase->dia = request('dia');
            $clase->sesion_id = request('sesion_id');
            $clase->user_id = request('user_id');
            $clase->materia_id = request('materia_id');
            $clase->aula_id = request('aula_id');
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
    public function destroy($id)
    {
        $clase = Clase::find($id);
        $clase->delete();
        return redirect()->route('clases.index')->with('info', 'Clase borrada');
    }
}