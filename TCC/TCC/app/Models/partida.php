<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\DB;

class partida extends Model
{
    use HasFactory;

    protected $fillable = ['id_campeonato','id_time_casa' ,'id_time_visitante', 'id_local', 'dataHora', 'status'];

    public function partida()
    {
        return $this->belongsTo(partida::class);
    }

    public function lstPartida($idPartida)
    {
        return partida::where('id', '=', $idPartida)
        ->get()->toArray();
    }

    public function insPartida($idCampeonato, $timeCasa, $timeFora, $local, $dataHora, $status = 0)
    {
        $objPartida = new partida();
        return $objPartida->create([
            'id_campeonato' => $idCampeonato,
            'id_time_casa'=>$timeCasa,
            'id_time_visitante'=>$timeFora,
            'id_local' => $local,
            'dataHora' => $dataHora,
            'status' => $status
        ]);
    }

    public function lstPartidasPorIdCampeonato($idCampeonato)
    {
        return partida::select('partidas.id', 'id_campeonato', 'time1.nome as timeCasa',
            'time2.nome as timeVisitante','local.endereco', 'dataHora','status',
            'gols_time_casa', 'gols_time_visitante'
            )
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

    public function lstCampeonatoPorPartida($idPartida)
    {
        return partida::select('id_campeonato')
        ->where('id', '=', $idPartida)
        ->get()->toArray();
    }

    public function encerraPartida($idPartida, $golsTimeCasa, $golsTimeVistante)
    {
        return partida::where(['id'=>$idPartida])->update([
            'status'=>1,
            'gols_time_casa' => $golsTimeCasa,
            'gols_time_visitante' => $golsTimeVistante
        ]);
    }

    public function lstDadosPartidaPorIdPartida($idPartida)
    {
        return partida::select('partidas.id', 'id_campeonato', 'time1.id as idTimeCasa',
            'time1.nome as timeCasa', 'time2.id as idTimeVisitante',
            'time2.nome as timeVisitante','local.endereco', 'dataHora','status',
            'gols_time_casa', 'gols_time_visitante'
            )
        ->join('times as time1', 'time1.id', '=', 'partidas.id_time_casa')
        ->join('times as time2', 'time2.id', '=', 'partidas.id_time_visitante')
        ->join('local', 'local.id', '=', 'partidas.id_local')
        ->where('partidas.id', '=', $idPartida)
        ->get()->toArray();
    }

    public function updPartida($id, $idTimeCasa, $idTimeVisitante, $idLocal, $dataHora)
    {
        partida::where(['id'=>$id])->update([
            'id_time_casa'=>$idTimeCasa,
            'id_time_visitante'=>$idTimeVisitante,
            'id_local' => $idLocal,
            'dataHora' => $dataHora
        ]);

        return true;
    }

    public function atualizaResultado($idPartida, $golsTimeCasa, $golsTimeVistante)
    {
        //dd($idPartida, $golsTimeCasa, $golsTimeVistante);
        return partida::where(['id'=>$idPartida])->update([
            'gols_time_casa' => $golsTimeCasa,
            'gols_time_visitante' => $golsTimeVistante
        ]);
    }

    public function lstSaldoGolPorTimeCasa($arrayIdTime, $idCampeonato)
    {
        //->selectRaw('id_time, count(id_jogador) as total')
        return partida::selectRaw('id_time_casa, SUM(gols_time_casa) as saldoGols')
        ->where('partidas.id_campeonato', '=', $idCampeonato)
        ->whereIn('partidas.id_time_casa', $arrayIdTime)
        ->groupby('id_time_casa')
        ->get()->toArray();
    }

    public function lstSaldoGolPorTimeVisitante($arrayIdTime, $idCampeonato)
    {
        return partida::selectRaw('id_time_visitante, SUM(gols_time_visitante) as saldoGols')
        ->where('partidas.id_campeonato', '=', $idCampeonato)
        ->whereIn('partidas.id_time_casa', $arrayIdTime)
        ->groupby('id_time_visitante')
        ->get()->toArray();
    }

    public function lstVitorias($idTime, $campeonato, $emCasa = true, $empate =  false)
    {
        if ($emCasa) {
            $time = 'partidas.id_time_casa';
            $operador = '>';
        } else {
            $time = 'partidas.id_time_visitante';
            $operador = '<';
        }

        if ($empate) {
            $operador = '=';
        }

        $query = partida::where($time, $idTime)
        ->where('id_campeonato', '=', $campeonato)
        ->where('status', '=', 1)
        ->where('gols_time_casa', $operador, 'gols_time_visitante')
        ->count();

        return $query;
    }

    public function lstNumeroPartidas($idTime, $campeonato, $emCasa = true)
    {
        if ($emCasa) {
            $time = 'partidas.id_time_casa';
        } else {
            $time = 'partidas.id_time_visitante';
        }
        $query = partida::where($time, $idTime)
        ->where('id_campeonato', '=', $campeonato)
        ->where('status', '=', 1)
        ->count();

        return $query;
    }
}
