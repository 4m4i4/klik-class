<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class PasoController extends Controller
{
    use AuthenticatesUsers;
    
    
  


      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function updatePasoMas( Request $request,User $user)
    {
        $usuario=$request->user();
         $user = Auth::user();
       if($user==$usuario){
        // dd($user);
        // $user = auth()->user();                    
        $paso = $user->paso; 
        // dd($paso);
        $user->paso = $paso + 1;
        $user->save();
        if($user->paso ==2) return redirect( route('sesions.index'));
        if($user->paso ==3) return redirect( route('clases.index'));
        if($user->paso ==5) return redirect( route('aulas.index'));
       }
     
       return redirect( route('home'));
    }

    
    public function updatePasoMenos( Request $request,User $user)
    {
        // $user = Auth::user();
      if($user=$request->user()){
        // $user= User::find($id);
        // $user = auth()->user();
        $paso = $user->paso; 
        $user->paso = $paso - 1;
        $user->save();
        if($user->paso ==1) return redirect( route('materias.index'));
        if($user->paso ==2) return redirect( route('sesions.index'));
        if($user->paso ==3) return redirect( route('clases.index'));
        if($user->paso ==4) return redirect( route('materias.index'));
      }
       return redirect( url()->previous());
    }
}
