<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class local extends Model
{
    use HasFactory;

    protected $table = "local";
    protected $fillable = [
        'nome',
        'endereco',
        'bairro',
        'numero',
        'cidade',
        'cep',
        'Eexcluido'
    ];

    public function local()
    {
        return $this->belongsTo(local::class);
    }

    public function lstLocais()
    {
        return local::select('id', 'nome', 'endereco', 'eExcluido')
            ->from('local')
            ->orderby('nome')
            ->get()->toArray();
    }

    public function lstLocalPorid($idLocal)
    {
        return local::from('local')
            ->where('id', '=', $idLocal)
            ->get()->toArray();
    }




}
