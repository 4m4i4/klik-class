<?php

namespace App\Http\Controllers;
use App\Models\Aula;
use App\Models\Clase;
use App\Models\Mesa;
use App\Models\Materia;
use App\Models\Estudiante;
use App\Models\User;
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
        if(Auth::check()){
            $user = Auth::user()->id; 
            // // versión A (el modelo Estudiante se importa en el index):
            // $aulas = Aula::where('user_id',$user)->with('user','clase','mesas')->get();
            // return view('configurar.aulas.index', compact('aulas'));

            // // versión B (El modelo Estudiante se importa aquí)
            // $aulas = Aula::where('user_id',$user)->get();
            // $clase = Clase::select('aula_id', 'materia_id')->get();
            // $estudiantes = Estudiante::select('id','materia_id')->get();
            // return view('configurar.aulas.index', compact('aulas', 'clase', 'estudiantes'));

            // // versión C (El modelo Estudiante se importa aquí)
            $aulas = Aula::where('user_id',$user)->with('user','clase','mesas')->get();
            $estudiantes = Estudiante::select('id','materia_id')->get();
            return view('configurar.aulas.index', compact('aulas', 'estudiantes'));
        }
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
                'num_estudiante' =>'nullable',
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

        // $aula = Aula::where('user_id',$user)->find($id);
        return view('configurar.aulas.show', compact('aula', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Aula $aula)
    {
        // $aula = Aula::find($id);
        $clase = Clase::select('aula_id', 'materia_id')->get();
        $estudiantes = Estudiante::select('id','materia_id')->get();
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
        // dd($request);
        // $colxfilas=request('num_columnas')*request('num_filas');
        $nombreAula= request('aula_name');
        $columnas=request('num_columnas');
        $filas=request('num_filas');
        $mesas=request('num_mesas');
        $maxMesas = $columnas * $filas;
        $msn_maxMesas ='Has puesto '.intval(  $mesas - $maxMesas) .' más que las que caben en '.$columnas .' columnas x '.$filas. ' filas';
         $msn='Parece que has olvidado introducir el grupo de estudiantes de ' .$nombreAula;
         if($mesas>$maxMesas)return redirect()->route('aulas.index')->with('success', $msn_maxMesas);
        // if(request('num_estudiante')==0)return redirect()->route('aulas.index')->with('success', $msn);
        if($request->validate([
                'aula_name' =>'required|string',
                'num_columnas' =>'required|integer|max:9|min:1',
                'num_filas' =>'required|integer|max:9|min:1',
                // 'num_mesas' =>'required|integer|max:20',
                // 'num_estudiante' =>'required|integer|min:1',
             ])
        )
        {
            // $aula = Aula::find($id);
            $aula->aula_name = request('aula_name');
            $aula->num_columnas = request('num_columnas');
            $aula->num_filas = request('num_filas');
            $aula->num_mesas = request('num_mesas');
            $aula->user_id = request('user_id');
            $aula->save();
            $aula->refresh();
            return redirect()->route('aulas.index');
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
}
