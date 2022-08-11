<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class campeonato extends Model
{
    use HasFactory;

    protected $fillable = ['nome','formato', 'Eexcluido', 'numeroTimes', 'dataInicio', 'dataFim'];

    public function campeonato()
    {
        return $this->belongsTo(campeonato::class);
    }

    public function lstCampeonatos($id)
    {
        return campeonato::where('id', '=', $id)->get();
    }
}
