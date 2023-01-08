<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

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
        return view('home');
    }

    public function perfil()
    {
        $modelUser =  new User();
        $usuario = $modelUser->lstDadosUsuarioPorId(Auth::user()->id);
        $usuario = $usuario[0];
        return view('times/cadastrar', compact('usuario'));
    }
}
