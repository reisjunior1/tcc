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
    protected $fillable = ['id_time', 'id_campeonato', 'id_jogador', 'status'];


    public function lstDadosJogadoresCampeonato($idCampeonato)
    {
        return jogadoresParticipantes::select('id_jogador')
        ->from('jogadores_participantes')
        ->where('id_campeonato', '=', $idCampeonato)
        ->where('status', '=', 1)
        ->get()->toArray();
    }

    public function lstDadosJogadoresCampeonatoTime($idCampeonato, $idTime, $operador = '=')
    {
        return jogadoresParticipantes::select('id_jogador')
        ->from('jogadores_participantes')
        ->where('id_campeonato', '=', $idCampeonato)
        ->where('id_time', $operador, $idTime)
        ->where('status', '=', 1)
        ->get()->toArray();
    }

    public function insParticipantes($idCampeonato, $idTime, $idJogador, $status)
    {
        $objJogadoresParticipantes = new jogadoresParticipantes();
        return $objJogadoresParticipantes->create([
            'id_time'=>$idTime,
            'id_campeonato'=>$idCampeonato,
            'id_jogador' => $idJogador,
            'status' => $status
        ]);
    }

    public function lstQtdeJogadoresCampeonato($idCampeonato)
    {
        return jogadoresParticipantes::groupBy('id_time')
        ->selectRaw('id_time, count(id_jogador) as total')
        ->where('id_campeonato', '=', $idCampeonato)
        ->where('status', '=', 1)
        ->get()->toArray();
    }

    public function delJogadoresParticipantesPorTime($idTime, $idCampeonato)
    {
        return jogadoresParticipantes::where('id_time', '=', $idTime)
        ->where('id_campeonato', '=', $idCampeonato)
        ->delete();
    }

    public function lstJogadoresPorTimeECampeonato($idTime, $idCampeonato)
    {
        return jogadoresParticipantes::select('id', 'id_jogador')
        ->from('jogadores_participantes')
        ->where('id_time', '=', $idTime)
        ->where('id_campeonato', '=', $idCampeonato)
        ->get()->toArray();
    }

    public function updParticipantes($id, $status)
    {
        return jogadoresParticipantes::where(['id'=>$id])->update([
            'status' => $status,
        ]);
    }
}
