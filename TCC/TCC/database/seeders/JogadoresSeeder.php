<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class JogadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jogadores')->insert([
            'cpf' => rand(10000000,100000000),
            'nome' => Str::random(20),
            'telefone' => rand(10000000000,90000000000),
            'Eexcluido' => rand(0,0),
            'nacimento' => Carbon::create('2000', '01', '01')
        ]);
    }
}
