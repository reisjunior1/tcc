<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class local extends Model
{
    use HasFactory;

    protected $fillable = [
    'Endereço',
    'Bairro',
    'Cidadede',
    'CEP'
    ];

    public function local()
    {
        return $this->belongsTo(local::class);
    }

    public function lstLocais()
    {
        return local::select('id', 'endereco')
            ->from('local')
            ->get()->toArray();
    }




}
