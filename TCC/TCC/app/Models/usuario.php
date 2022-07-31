<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    use HasFactory;

    protected $fillable = ['cpf', 'nome', 'telefone', 'email'];

    public function usuario()
    {
        return $this->belongsTo(usuario::class);
    }
}
