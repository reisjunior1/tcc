<?php

namespace App\Models;

use GuzzleHttp\Promise\Create;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timesParticipantes extends Model
{
    use HasFactory;

    protected $fillable = ['id_time', 'id_campeonato', 'Eexcluido'];

    public function lstTimesParticipantes($idCampeonato)
    {
        return timesParticipantes::selectRaw('times.id, times.nome')
        ->join('times', 'times.id', '=', 'id_time')
        ->where('id_campeonato', '=', $idCampeonato)
        ->get()->toArray();
    }

    public function lstQtdTimesParticipantes($idCampeonato)
    {
        return timesParticipantes::selectRaw('count(id_time) as total')
        ->where('id_campeonato', '=', $idCampeonato)
        ->get()->toArray();
    }

    public function insParticipantes($idCampeonato, $idTime)
    {
        $objTimeParticipante = new timesParticipantes();
        return $objTimeParticipante->create([
            'id_time'=>$idTime,
            'id_campeonato'=>$idCampeonato,
            'Eexcluido' => 0
        ]);
    }

    public function delTimesParticipantes($idTime)
    {
        return timesParticipantes::where('id_time', '=', $idTime)
        ->delete();
    }
}
