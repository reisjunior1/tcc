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

    public function lstLocais($ativo = false)
    {
        $query = local::select('id', 'nome', 'endereco', 'eExcluido')
            ->from('local')
            ->orderby('nome');

        $query->when($ativo, function ($q) {
                return $q->where('eExcluido', '=', '0');
            });
        
        return $query->get()->toArray();
    }

    public function lstLocalPorid($idLocal)
    {
        return local::from('local')
            ->where('id', '=', $idLocal)
            ->get()->toArray();
    }




}
