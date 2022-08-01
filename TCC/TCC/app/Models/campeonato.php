<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class campeonato extends Model
{
    use HasFactory;

    protected $fillable = ['nome','formato'];

    public function campeonato()
    {
        return $this->belongsTo(campeonato::class);
    }
}
