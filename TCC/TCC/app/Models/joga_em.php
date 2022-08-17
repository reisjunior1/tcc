<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class joga_em extends Model
{
    use HasFactory;

    protected $fillable = [
    'id_jogador',
    'id_Time',
    'Eexcluido'];

    public function joga_em()
    {
        return $this->belongsTo(joga_em::class);
    }

    public function lstJogadoresPorTime($idTime)
    {
        return time::select('jogadores.id', 'jogadores.nome')
            ->from('joga_em')
            ->join('jogadores', 'jogadores.id', '=', 'joga_em.id_jogador')
            ->where('joga_em.id_time', '=', $idTime)
            ->get()->toArray();
        //SELECT j.id_jogador, jg.nome 
        //From joga_em j 
        //INNER JOIN jogadores jg ON jg.id = j.id_jogador 
        //WHERE j.id_time = 1;
    }
}
