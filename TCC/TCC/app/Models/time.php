<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class time extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

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

    
}
