<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class acao extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function acao()
    {
        return $this->belongsTo(acao::class);
    }

    public function lstAcao()
    {
        return acao::from('acao')->get()->toArray();
    }
}
