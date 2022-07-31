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

    
}
