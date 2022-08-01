<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampeonatosController extends Controller
{
    public function cadastrarCampeonato()
    {
        //var_dump('oi');
        return view('campeonatos/cadastrar');
    }
}
