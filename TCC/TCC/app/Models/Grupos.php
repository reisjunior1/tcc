<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Grupos extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'id_campeonato',
        'numeroTimes',
        'Eexcluido'
    ];

    public function inGrupo($nome, $idCampeonato, $numeroTimes)
    {
        $objPartida = new Grupos();
        return $objPartida->create([
            'nome' => $nome,
            'id_campeonato'=>$idCampeonato,
            'numeroTimes'=>$numeroTimes,
            'Eexcluido' => 0
        ]);
    }

    public function lstDadosGrupo($idGrupo){
        return Grupos::where('id', '=', $idGrupo)
        ->where('Eexcluido', '=', 0)
        ->get()->toArray();
    }

    public function lstGruposPorIdCampeonato($idCampeonato)
    {
        return Grupos::where('id_campeonato', '=', $idCampeonato)
        ->where('Eexcluido', '=', 0)
        ->get()->toArray();
    }

    public function delGrupo($idGrupo)
    {
        Grupos::where(['id'=>$idGrupo])->update([
            'Eexcluido'=>1
        ]);

        return true;
    }

}
