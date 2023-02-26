<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sumula extends Model
{
    use HasFactory;

    protected $fillable = ['id_partida', 'id_acao', 'id_time', 'numero_camisa', 'minutos'];
    protected $table = 'sumula';

    public function sumulas()
    {
        return $this->belongsTo(sumula::class);
    }

    public function lstSumula()
    {
        return sumula::from('sumulas')->get()->toArray();
    }

    public function insAcao($partida, $acao, $time, $numero, $minutos)
    {
        $objSumula = new sumula();
        return $objSumula->create([
            'id_partida' => $partida,
            'id_acao'=> $acao,
            'id_time'=> $time,
            'numero_camisa' => $numero,
            'minutos' => $minutos
        ]);
    }

    public function lstEventosPorPartida($idPartida, $idTime = null, $idAcao = null)
    {
        $query = sumula::select('sumula.id as idAcao', 'id_partida', 'id_acao', 'acao.descricao',
            'id_time', 'minutos', 'times.nome as time', 'sumula.numero_camisa')
        ->join('acao', 'acao.id', '=', 'sumula.id_acao')
        ->join('times', 'times.id', '=', 'sumula.id_time')
        ->where('id_partida', '=', $idPartida)
        ->orderby('minutos');
        
        $query->when(!is_null($idTime), function ($q) use ($idTime) {
            return $q->where('times.id', '=', $idTime);
        });

        $query->when(!is_null($idAcao), function ($q) use ($idAcao) {
            return $q->where('acao.id', '=', $idAcao);
        });

        return $query->get()->toArray();
    }

    public function updOcorrencia($idOcorrencia, $idAcao, $idTime, $numero, $minutos)
    {
        sumula::where(['id'=>$idOcorrencia])->update([
            'id_acao'=>$idAcao,
            'id_time'=>$idTime,
            'numero_camisa' =>$numero,
            'minutos' => $minutos
        ]);

        return true;
    }

    public function excluiOcorrencia($idOcorrencia)
    {
        //dd($idOcorrencia);
        return sumula::where('id', '=', $idOcorrencia)
        ->delete();

    }
}
