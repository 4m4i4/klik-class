<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Boton;
use App\Models\Botontipo;
use Illuminate\Support\Facades\DB;

class BotonController extends Controller
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
            $botons = Boton::all();
            return response()->json(['success' => true, 'botons' => $botons], 200);
         }
    }




    /**
     * Show the form for clone gradual button.
     *
     * @return \Illuminate\Http\Response
     */
    public function inicializarBotones( Request $request,User $user)
    {
        $user = $request->user();
        $user_paso = $user->paso;
        if($user_paso == 5){
            $botontipo = DB::table('botontipos')->get();
            $botontipo_count = $botontipo->count();
            // dd($botontipo_count);            
            if($botontipo_count < 3){
                $botontipo = DB::table('botontipos')->insert([
                    ['id'=>1,
                     'tipo'=>'booleano'
                    ],
                    ['id'=>2,
                     'tipo'=>'gradual'
                    ],
                    ['id'=>3,
                     'tipo'=>'matriz'
                    ]
                ]);
                DB::table('botons')->insert([
                    ['id'=>1,
                     'default'=>0,
                     'v_last'=>1,  
                     'botontipo_id'=>1,
                     'bt_name'=>'Trabaja',   
                     'descripcion'=>'0 = Trabaja', 
                     'pasos'=>2,
                     'items'=>'Trabaja, No trabaja',
                     'user_id'=>null
                    ],
                    ['id'=>2,
                     'default'=>0,
                     'v_last'=>100,
                     'botontipo_id'=>2,
                     'bt_name'=>'Participa', 
                     'descripcion'=>'0 = No participa',
                     'pasos'=>5,   
                     'items'=>null, 
                     'user_id'=>null
                    ],
                    ['id'=>3,
                     'default'=>0,
                     'v_last'=>2,  
                     'botontipo_id'=>3,
                     'bt_name'=>'Asistencia',
                     'descripcion'=>'Presente, Ausente, Retraso', 
                     'pasos'=>null,
                     'items'=>'Presente, Ausente, Retraso',
                     'user_id'=>null
                     ]
                ]);
            }
            DB::table('users')->where('id', $user->id)->update(['paso'=> '6']);
        }           
    return redirect( route('personalizar'));
    }

    /**
     * Show the form for clone boolean button.
     *
     * @return \Illuminate\Http\Response
     */
    public function cloneBooleano()
    {
        if(Auth::check()){
            $user = Auth::user()->id;
            $botons = Boton::find(1);
        return view('configurar.botones.cloneBooleano', compact('botons'));
        }
    }

    /**
     * Show the form for clone gradual button.
     *
     * @return \Illuminate\Http\Response
     */
    public function cloneGradual()
    {
        if(Auth::check()){
            $user = Auth::user()->id;
            $botons = Boton::find(2);
        return view('configurar.botones.cloneGradual', compact('botons'));
        }
    }

        /**
     * Show the form for clone gradual button.
     *
     * @return \Illuminate\Http\Response
     */
    public function cloneAsistencia()
    {
        if(Auth::check()){
            $user = Auth::user()->id;
            $botons = Boton::find(3);
        return view('configurar.botones.cloneAsistencia', compact('botons'));
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
