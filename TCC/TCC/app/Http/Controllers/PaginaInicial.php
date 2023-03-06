<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\partida;
use App\Models\Campeonato;

class PaginaInicial extends Controller
{
    //

    public function index ()
    {
        $modelPartida = new partida();
        $ultimasPartidas = $modelPartida->lstUltimasPartidas(null, 10);
        $proximasPartidas = $modelPartida->lstProximasPartidas(null, 10);

        $modelCampeonato = new campeonato();
        $campeonatos = $modelCampeonato->lstCampeonatos(true);

        return view(
            'times.paginainicial',
            compact(
                'ultimasPartidas',
                'proximasPartidas',
                'campeonatos'
            )
        );
    }

}
