<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TimeParticipaGrupo extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_campeonato',
        'id_time',
        'Eexcluido'
    ];

    protected $table = 'time_participa_grupo';

    public function inTime($idGrupo, $idTime)
    {
        $objPartida = new TimeParticipaGrupo();
        return $objPartida->create([
            'id_campeonato'=>$idGrupo,
            'id_time' => $idTime,
            'Eexcluido' => 0
        ]);
    }

    public function lstTimesPorGrupo($idGrupo)
    {
        return TimeParticipaGrupo::selectRaw('times.id, times.nome')
        ->join('times', 'times.id', '=', 'id_time')
        ->where('id_campeonato', '=', $idGrupo)
        ->where('time_participa_grupo.Eexcluido', '=', 0)
        ->get()->toArray();
    }

    public function lstQtdTimesParticipantes($idGrupo)
    {
        return TimeParticipaGrupo::selectRaw('count(id_time) as total')
        ->where('id_campeonato', '=', $idGrupo)
        ->where('Eexcluido', '=', 0)

        ->get()->toArray();
    }

    public function delTimeGrupo($idTime, $idGrupo)
    {
        TimeParticipaGrupo::where(['id_time'=>$idTime, 'id_campeonato'=>$idGrupo])->update([
            'Eexcluido'=>1
        ]);

        return true;
    }
}
