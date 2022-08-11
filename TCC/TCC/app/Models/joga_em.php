<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class joga_em extends Model
{
    use HasFactory;

    protected $fillable = [
    'id_jogador',
    'id_Time',
    'Eexcluido'];

    public function joga_em()
    {
        return $this->belongsTo(joga_em::class);
    }
}
