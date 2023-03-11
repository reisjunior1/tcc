<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jogador extends Model
{
    use HasFactory;
    protected $table = "jogadores";
    protected $fillable = ['cpf', 'nome','telefone', 'apelido', 'email', 'nacimento','Eexcluido'];

    public function jogador()
    {
        return $this->belongsTo(jogadores::class);
    }

    public function lstJogadores($arrayId)
    {
        return jogador::select('id', 'nome', 'apelido', 'telefone', 'nacimento', 'cpf', 'Eexcluido')
            ->from('jogadores')
            ->wherein('id', $arrayId)
            ->get()->toArray();
    }

    public function lstTodosJogadores($eExcluido = null)
    {
        $query = jogador::select('id', 'nome', 'apelido')
            ->from('jogadores')
            ->orderby('nome');
           // ->get()->toArray();

        $query->when(!is_null($eExcluido), function ($q) use($eExcluido) {
            return $q->where('Eexcluido', '=', $eExcluido);
        });

        return $query->get()->toArray();
    }
}
