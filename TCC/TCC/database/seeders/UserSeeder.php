<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'cpf' => '12345678950',
            'name' => 'ADM',
            'telefone' => '(31) 99898-1116',
            'email' => 'adm@mail.com',
            'tipo' => '4',
            'password' => Hash::make('senha'),
        ])->roles()->attach(4);
    }
}
