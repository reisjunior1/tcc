<?php

namespace App\Models;

use GuzzleHttp\Promise\Create;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timesParticipantes extends Model
{
    use HasFactory;

    protected $fillable = ['id_time', 'id_campeonato', 'Eexcluido'];

    public function lstParticipantes($id)
    {
        return timesParticipantes::where('id_campeonato', '=', $id)->get()->toArray();
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
}
