<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class arbritos extends Model
{
    use HasFactory;
    protected $table = "arbitro";
    protected $fillable = ['nome','cpf', 'nome', 'telefone', 'email', 'Eexcluido'];

    public function arbritos()
    {
        return $this->belongsTo(arbritos::class);
    }

    public function lstArbritos($eExcluido = null)
    {
        $query = arbritos::from('arbitro');

        $query->when(!is_null($eExcluido), function ($q) use ($eExcluido) {
            return $q->where('arbitro.Eexcluido', '=', $eExcluido);
        });

        return $query->get()->toArray();
    }

    public function lstArbritosPorId($id)
    {
        return arbritos::where('id', '=', $id)
            ->get()->toArray();
    }
}
