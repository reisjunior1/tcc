<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class partida extends Model
{
    use HasFactory;

    protected $fillable = ['id_campeonato','id_time_casa' ,'id_time_visitante', 'id_local', 'dataHora'];

    public function partida()
    {
        return $this->belongsTo(partoda::class);
    }

    public function lstPartida($idPartida)
    {
        return partida::where('id', '=', $idPartida)
        ->get()->toArray();
    }

    public function insPartida($idCampeonato, $timeCasa, $timeFora, $local, $data, $hora)
    {
        $objPartida = new partida();
        return $objPartida->create([
            'id_campeonato' => $idCampeonato,
            'id_time_casa'=>$timeCasa,
            'id_time_visitante'=>$timeFora,
            'id_local' => $local,
            'dataHora' => $data,
        ]);
    }

    public function lstPartidasPorIdCampeonato($idCampeonato)
    {
        return partida::select('partidas.id', 'id_campeonato', 'time1.nome as timeCasa', 'time2.nome as timeVisitante','local.endereco', 'dataHora','status')
        ->join('times as time1', 'time1.id', '=', 'partidas.id_time_casa')
        ->join('times as time2', 'time2.id', '=', 'partidas.id_time_visitante')
        ->join('local', 'local.id', '=', 'partidas.id_local')
        ->where('id_campeonato', '=', $idCampeonato)
        ->orderBy('dataHora')
        ->get()->toArray();
    }

    public function delPartida($idPartida)
    {
        return partida::where('id', '=', $idPartida)
        ->delete();
    }
}