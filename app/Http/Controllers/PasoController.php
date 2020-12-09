<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class PasoController extends Controller
{
    use AuthenticatesUsers;
    


     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function editPasoMas($id)
    // {
    //     $user = User::find($id);
    //     return view('configurar.materias.edit', compact( 'materia'));
    // }
        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function updatePasoMas( Request $request, $id)
    {
        $user= User::find($id);
        // $user = auth()->user();
        $paso = $user->paso; 
        $user->paso = $paso + 1;
        $user->save();
       return redirect( url()->previous());
    }

    
    public function updatePasoMenos( Request $request, $id)
    {
        $user= User::find($id);
        // $user = auth()->user();
        $paso = $user->paso; 
        $user->paso = $paso - 1;
        $user->save();
       return redirect( url()->previous());
    }
}
