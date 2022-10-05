<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sumula extends Model
{
    use HasFactory;

    protected $fillable = ['id_partida', 'id_acao', 'id_time', 'minutos'];
    protected $table = 'sumula';

    public function sumulas()
    {
        return $this->belongsTo(sumula::class);
    }

    public function lstSumula()
    {
        return sumula::from('sumulas')->get()->toArray();
    }

    public function insAcao($partida, $acao, $time, $minutos)
    {
        $objSumula = new sumula();
        return $objSumula->create([
            'id_partida' => $partida,
            'id_acao'=> $acao,
            'id_time'=> $time,
            'minutos' => $minutos
        ]);
    }

    public function lstEventosPorPartida($idPartida)
    {
        return sumula::select('id_partida', 'id_acao', 'acao.descricao', 'id_time', 'minutos')
        ->join('acao', 'acao.id', '=', 'sumula.id_acao')
        ->where('id_partida', '=', $idPartida)
        ->get()->toArray();
    }
}
