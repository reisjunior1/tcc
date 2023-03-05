<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Campeonato extends Model
{
    use HasFactory;

    protected $fillable = ['nome','formato', 'Eexcluido', 'numeroTimes', 'dataInicio', 'dataFim'];

    public function campeonato()
    {
        return $this->belongsTo(campeonato::class);
    }

    public function lstCampeonatos($array = false)
    {
        if (!$array) {
            return campeonato::get();
        } else {
            $query = campeonato::where('Eexcluido', '=', 0)
            ->orderby('dataInicio', 'DESC');
            return $query->take(10)->get()->toArray();

        }
    }

    public function lstCampeonatosPorId($id)
    {
        return campeonato::wherein('id', $id)->get();
    }

    public function delCampeonato($idCampeonato)
    {
        return campeonato::where('id', '=', $idCampeonato)
        ->delete();
    }

    public function lstCampeonatosPorFormato($formato = null)
    {  

        return campeonato::select('campeonatos.id')
            ->where('formato', '=', $formato)
            ->get()->toArray();
    }

    public function lstCampeonatosPorTime($time = null)
    {  
        return campeonato::select('campeonatos.id')
            ->join('times_participantes', 'times_participantes.id_campeonato', '=', 'campeonatos.id')
            ->where('times_participantes.id_time', '=', $time)
            ->groupby('campeonatos.id')
            ->get()->toArray();

    }

    public function lstCampeonatosPorPeriodo($dataInicio, $dataFim)
    {
        return campeonato::select('campeonatos.id')
            ->where('campeonatos.dataInicio', '>=', $dataInicio)
            ->where('campeonatos.dataFim', '<=', $dataFim)
            ->get()->toArray();
    }

    public function getTabela($idCampeonato)
    {
        return campeonato::select('campeonatos.id', 'campeonatos.nome,')
            ->where('campeonatos.id', '=', $idCampeonato)
            ->get()->toArray();
    }
}
