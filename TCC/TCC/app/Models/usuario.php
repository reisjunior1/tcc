<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nome' ,'cpf', 'telefone', 'tipo', 'email', 'senha'];

    public function usuario()
    {
        return $this->belongsTo(usuario::class);
    }
}
