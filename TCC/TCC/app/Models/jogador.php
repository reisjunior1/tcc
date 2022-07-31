<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jogador extends Model
{
    use HasFactory;

    protected $fillable = ['cpf', 'nome', 'telefone', 'nascimento'];

    public function jogador()
    {
        return $this->belongsTo(jogador::class);
    }
}
