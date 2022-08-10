<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timesParticipantes extends Model
{
    use HasFactory;

    protected $fillable = ['id_time','id_jogador', 'Eexcluido'];

    public function lstParticipantes($id)
    {
        return timesParticipantes::where('id_campeonato', '=', $id)->get()->toArray();
    }
}
