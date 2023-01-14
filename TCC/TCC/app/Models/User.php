<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'telefone',
        'tipo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function lstDadosUsuarioPorId($id)
    {
        return User::where('id', '=', $id)
            ->get();
    }

    public function updUsuario($id, $nome, $cpf, $telefone, $email)
    {
        User::where(['id'=>$id])->update([
            'name'=>$nome,
            'cpf'=>$cpf,
            'telefone' => $telefone,
            'email' => $email
        ]);
        return true;
    }

    public function updSenha($idUsuario, $novaSenha)
    {
        User::where(['id'=>$idUsuario])->update([
            'password'=>$novaSenha
        ]);
        return true;
    }

    public function ltsTodosUsuario()
    {
        return User::get()->toArray();
    }
}
