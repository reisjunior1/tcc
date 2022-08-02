<?php

namespace App\Http\Controllers;

use App\Models\campeonato;
use App\Models\usuario;
use App\Models\time;
use Illuminate\Http\Request;


class CampeonatosController extends Controller
{
    private $objUsuario;
    private $objTime;
    private $objCampeonato;

    public function __construct()
    {
        $this->objUsuario = new usuario();
        $this->objTime = new time();
        $this->objCampeonato = new campeonato();
    }

    public function index()
    {
        $campeonatos = $this->objCampeonato->all();
        return view('campeonatos/index', compact('campeonatos'));
    }
    public function cadastrarCampeonato()
    {
        $times = $this->objTime->all();
        return view('campeonatos/cadastrar', compact('times'));
    }

    public function pesquisar($formato)
    {
        dd($formato);
        die();
    }
}
