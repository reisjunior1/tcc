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

    public function insAcao($partida, $acao, $time)
    {
        $objSumula = new sumula();
        return $objSumula->create([
            'id_partida' => $partida,
            'id_acao'=>$acao,
            'id_time'=>$time,
        ]);
    }
}
