<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    use HasFactory;

    public function lstArquivos($partidas)
    {
        return Arquivo::wherein('id_partida', $partidas)
            ->get()->toArray();
    }

    public function delArquivos($idPartida)
    {
        Arquivo::where(['id_partida'=>$idPartida])->delete();

        return true;
    }
}
