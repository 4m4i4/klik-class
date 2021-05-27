<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Boton;

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
     * Show the form for clone boolean button.
     *
     * @return \Illuminate\Http\Response
     */
    public function cloneBooleano()
    {
        return view('configurar.botones.cloneBooleano');
    }

    /**
     * Show the form for clone gradual button.
     *
     * @return \Illuminate\Http\Response
     */
    public function cloneGradual()
    {
        return view('configurar.botones.cloneGradual');
    }

        /**
     * Show the form for clone gradual button.
     *
     * @return \Illuminate\Http\Response
     */
    public function cloneAsistencia()
    {
        return view('configurar.botones.cloneAsistencia');
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
