<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {
        $user = auth()->user();
        // $id= $user->id;
        // dd( $user);
        $paso = $user->paso;
        // // echo "Paso: ". $paso."<br/>";
        // $paso2 = $user->paso2;
        // // echo "Paso2: ". $paso2."<br/>";
        // $paso3 = $user->paso3;
        // // echo "Paso3: ". $paso3."<br/>";
        return view('home',compact('user'));
    }

    
}
