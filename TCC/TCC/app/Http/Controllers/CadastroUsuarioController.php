<?php

namespace App\Http\Controllers;

use App\Http\Requests\SenhaRequest;
use Illuminate\Http\Request;
use App\Models\usuario;
use App\Http\Requests\UsuarioRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CadastroUsuarioController extends Controller

{ 
    private $objUsuario;



    public function __construct()
    {
        $this->objUsuario = new usuario();
        
    }

    public function update(Request $request, $id)
    {
        $modelUser = new User();
        $modelUser->updUsuario(
            $id,
            $request->inNome,
            $request->inCpf,
            $request->inTelefone,
            $request->inEmail
        );
        
        $usuario = $modelUser->lstDadosUsuarioPorId($id);
        $usuario = $usuario[0];
        session()->flash('mensagem', "Os dados do usuário foram atualizados!");
        return view('times/cadastrar', compact('usuario'));
    }

    public function atualizarSenha($id)
    {
        $modelUsuario = new User();
        $usuario = $modelUsuario->lstDadosUsuarioPorId($id);
        return view('usuario/atualizarSenha', compact('usuario'));
    }

    public function validaAlterarSenha(SenhaRequest $request)
    {
        $modelUsuario = new User();
        $usuario = $modelUsuario->lstDadosUsuarioPorId($request['hdUsuario']);

        if(password_verify($request['inSenhaAtual'], $usuario[0]['password'])){
            if($request['inSenhaAtual'] == $request['inNovaSenha']){
                $msg = "A nova senha não pode ser igual a senha atual!";
            }else{
                if($request['inNovaSenha'] != $request['inConfirmaSenha']){
                    $msg = "As senhas não coenhecidem!";
                }else{
                    $modelUsuario->updSenha(
                        $request['hdUsuario'],
                        password_hash($request['inConfirmaSenha'], PASSWORD_DEFAULT)
                    );
                    session()->flash('mensagem', 'Senha atualizada com sucesso');
                    $usuario = $usuario[0];
                    return view('times/cadastrar', compact('usuario'));
                }
            }
        }else{
            $msg = "Senha atual incorreta!";
        }
        session()->flash('mensagem', $msg);
        return view('usuario/atualizarSenha', compact('usuario'));
        
    }

    public function sair()
    {
        if (session_status() !== PHP_SESSION_ACTIVE ){
            session_start();
            unset($_SESSION);
            session_destroy();
        }
        return view('times.paginainicial');

    }

    public function tipoUsuario()
    {
        $modelUsuario = new User();
        $usuarios = $modelUsuario->ltsTodosUsuario();

        $papeis = \Spatie\Permission\Models\Role::all();

        return view('usuario/gerenciarTipo', compact('usuarios', 'papeis'));
    }

    public function validaTipoUsuario(Request $request)
    {
        //dd($request);
        $modelUser = new User();
        $user = $modelUser->lstDadosUsuarioPorId($request->slUsuario);
        if ($user[0]->hasAnyRole([$request->slPapel])) {
            $modelUsuario = new User();
            $usuarios = $modelUsuario->ltsTodosUsuario();
            $papeis = \Spatie\Permission\Models\Role::all();
            $dados['slUsuario'] = $request->slUsuario;
            $dados['slPapel'] = $request->slPapel;
            //dd($dados);
            session()->flash('mensagem', 'O usuário já possui este papel!');
        } else {
            $user[0]->assignRole($request->slPapel);
        }
        //dd($dados['slUsuario']);
        return view('usuario/gerenciarTipo', compact('usuarios', 'papeis', 'dados'));

    }

}

