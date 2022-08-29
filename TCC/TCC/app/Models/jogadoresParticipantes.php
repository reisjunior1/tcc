<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jogadoresParticipantes extends Model
{
    use HasFactory;
    
    protected $casts = [
        'id_jogador' => 'array'
    ];
    protected $fillable = ['id_time', 'id_campeonato', 'id_jogador'];


    public function lstDadosJogadoresCampeonato($idCampeonato)
    {
        return jogadoresParticipantes::select('id_jogador')
        ->from('jogadores_participantes')
        ->where('id_campeonato', '=', $idCampeonato)
        ->get()->toArray();
    }

    public function insParticipantes($idCampeonato, $idTime, $idJogador)
    {
        $objJogadoresParticipantes = new jogadoresParticipantes();
        return $objJogadoresParticipantes->create([
            'id_time'=>$idTime,
            'id_campeonato'=>$idCampeonato,
            'id_jogador' => $idJogador
        ]);
    }

    public function lstQtdeJogadoresCampeonato($idCampeonato)
    {
        return jogadoresParticipantes::groupBy('id_time')
        ->selectRaw('id_time, count(id_jogador) as total')
        ->where('id_campeonato', '=', $idCampeonato)
        ->get()->toArray();
    }

    public function delJogadoresParticipantesPorTime($idTime, $idCampeonato)
    {
        return jogadoresParticipantes::where('id_time', '=', $idTime)
        ->where('id_campeonato', '=', $idCampeonato)
        ->delete();
    }
}
