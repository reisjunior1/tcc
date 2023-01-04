<?php

namespace Database\Seeders;

use App\Models\usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        usuario::create([
            'cpf' => '12345678934',
            'nome' => 'Jean',
            'telefone' => '(31) 99898-8888',
            'email' => 'jean@gmail.com',
            'tipo' => 'UC',
            'senha' => Hash::make('senha'),
        ])->roles()->attach(2);
    }
}
