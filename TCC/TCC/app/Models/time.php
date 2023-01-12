<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class time extends Model
{
    use HasFactory;

    protected $fillable = [	
        'id_usuario',
        'sigla',
        'nome',
        'id_local',
        'Eexcluido',
        'endereco',
        'cidade',
        'bairro',
        'complemento',
        'cep',
        'estado',

    ];

    public function time()
    {
        return $this->belongsTo(time::class);
    }

    public function lstTimes($arrayTimes)
    {
        return time::select('id', 'nome')
            ->whereIn('id', $arrayTimes)
            ->get()->toArray();
    }

    public function sltTimes()
    {
        return time::select('id', 'nome')
            ->where('Eexcluido', '=', '0')
            ->get()->toArray();
    }

    public function lstTimesPorIdUsuario($idUsurio)
    {
        return time::select('id', 'sigla', 'nome', 'Eexcluido')
            ->where('id_usuario', '=', $idUsurio)
            ->get()->toArray();
    }
}
