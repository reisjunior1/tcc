<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jogador extends Model
{
    use HasFactory;

    protected $fillable = ['cpf', 'nome','telefone', 'nascimento','Eexecluido'];

    public function jogador()
    {
        return $this->belongsTo(jogador::class);
    }

    public function lstJogadoresPorTime($idTime)
    {
        return time::select('jogador.id', 'jogador.nome')
            ->join('joga_em', 'joga_em.id_jogador', '=', 'jogador.id')
            ->where('joga_em.id_time', '=', $idTime)
            ->get()->toArray();
    }
}
