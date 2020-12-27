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
        $sesiones = Sesion::get();
        return view('configurar.sesions.index', compact('sesiones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configurar.sesions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           // si pasa la validación... no funciona er el formulario modadl
        if($request->validate([
                'inicio' =>'required',
                'fin'=>'required'
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
        $sesion = Sesion::find($id);
        return view('configurar.sesions.edit', compact( 'sesion'));
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
           // si pasa la validación... no funciona er el formulario modadl
        if($request->validate([
                'inicio' =>'required',
                'fin'=>'required'
                ])
            )
        {   
            $sesion = Sesion::find($id);
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
    public function destroy($id)
    {
        //
    }
}
