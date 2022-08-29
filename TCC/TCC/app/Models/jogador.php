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

    public function lstJogadores($arrayId)
    {
        return jogador::select('id', 'nome')
            ->from('jogadores')
            ->wherein('id', $arrayId)
            ->get()->toArray();
    }

    
}
