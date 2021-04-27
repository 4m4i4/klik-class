<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class PasoController extends Controller
{
    use AuthenticatesUsers;
    
    
  
    public function crearCurso( Request $request,User $user)
    {
       
        if(Auth::check()){
          $user = $request->user();
          $paso = $user->paso;
          if($paso =='0'){
            $user->paso = '1';
            $user->save();       
          }
        }

        return redirect( route('home'));
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function updatePasoMas( Request $request,User $user)
    {

      if($user = $request->user()){
          $paso = $user->paso;
          if($paso < 5){
            $user->paso = (string)((int)$paso + 1);
            $user->save();
            $user->refresh();
          }        
          if($user->paso ==2) return redirect( route('sesions.index'));
          if($user->paso ==3) return redirect( route('clases.index'));
           return redirect( route('home'));
          if($user->paso ==5 && url()->current()!=='/home'){
            $user->paso = 6;
            $user->save();
            $user->refresh();
          }

        }
     
        return redirect( route('home'));
    }

    
    public function updatePasoMenos( Request $request,User $user)
    {

      if($user = $request->user()){
        $paso = $user->paso;
        // Se limita que paso pueda ser inferior a 0
        // resta un paso y redirige a la página
        if($paso > 0){
          $user->paso = (string)((int)$paso - 1);
          $user->save();
          $user->refresh();
        }
        if($user->paso ==0) return redirect( route('home'));   
        if($user->paso ==1) return redirect( route('materias.index'));
        if($user->paso ==2) return redirect( route('sesions.index'));
        if($user->paso ==3) return redirect( route('clases.index'));
        if($user->paso ==4) return redirect( route('materias.index'));
        if($user->paso ==5) return redirect( route('home'));
      }
      return redirect( url()->previous());
    }
}
