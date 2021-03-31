<?php

namespace App\Http\Controllers;
use App\Models\Sesion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class SesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = auth()->user()->id; 
        $sesions = Sesion::where('user_id',$user)->get();
        return view('configurar.sesions.index', compact('sesions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user()->id;
        $sesions = Sesion::where('user_id',$user)->select('fin')->latest();
        $last = $sesions->count();
        $siguiente = "00:00:00";
        
        if($last > 0) $siguiente =  date_format(date_create($sesions->value('fin')),'H:i');
        // dd($siguiente);
        return view('configurar.sesions.create', compact('siguiente'));

      

        // return view('configurar.sesions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           // si pasa la validación... 
        if($request->validate([
                // 'inicio' =>'required|date_format:H:i|after_or_equal:siguiente',
                'inicio' =>'required|date_format:H:i',
                'fin'=>'required|date_format:H:i|after:inicio'
                ])
            )
        {   
            $sesion = new Sesion([
                'inicio'=>request('inicio'),
                'fin'=>request('fin'),
                'user_id'=>request('user_id')
            ]);

            $msn= 'Se ha añadido la hora de la sesión';
            $sesion->save();
            return redirect()->route('sesions.index')->with('info', $msn);
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sesion $sesion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sesion $sesion)
    {
        $user = Auth::user()->id;
        return view('configurar.sesions.edit', compact( 'sesion','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sesion $sesion)
    {
           // si pasa la validación... 
        if($request->validate([
                 'inicio' =>'required|date_format:H:i',
                'fin'=>'required|date_format:H:i|after:inicio'
                ])
            )
        {   
            // $sesion = Sesion::find($id);
            $sesion->inicio = request('inicio');
            $sesion->fin = request('fin') ;
            $sesion->user_id = request('user_id');

            $msn = 'Se ha actualizado la hora de la sesión';
            $sesion->save();

            return redirect()->route('sesions.index')->with('info', $msn);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sesion $sesion)
    {
        //
    }
}
