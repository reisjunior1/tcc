<?php

namespace Database\Seeders;

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
        DB::table('usuarios')->insert([
            'cpf' => rand(10000000,100000000),
            'nome' => Str::random(20),
            'telefone' => rand(10000000000,90000000000),
            'email' => Str::random(10).'@gmail.com',
            'tipo' => Str::random(2),
            'senha' => Hash::make('password'),
        ]);
    }
}
