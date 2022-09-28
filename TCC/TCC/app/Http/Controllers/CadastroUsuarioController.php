<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario;
use App\Http\Requests\UsuarioRequest;




class CadastroUsuarioController extends Controller

{ 
    private $objUsuario;



    public function __construct()
    {
        $this->objUsuario = new usuario();
        
    }



    public function index()
    {
        return view(view:'times.cadastrar');

    }

    public function cadastrar()
    {
        return view(view:'times.cadastrar');

    }
   





    public function store(UsuarioRequest $request)
    { 
        $cadastro=$this->objUsuario->create([
            'nome'=>$request->inNome,
            'cpf'=>$request->inCpf,
            'email' => $request->inEmail,
            'telefone' => $request->inTelefone,
            'tipo'=>'UC',
            'senha'=> password_hash($request->inSenha, PASSWORD_DEFAULT)
        ]);
        if($cadastro){
            return redirect('usuario');
        }
    }

    public function update(Request $request, $id)
    {
        if (session_status() !== PHP_SESSION_ACTIVE ){
            session_start();
        }

        $modelUsuario = new usuario();
        $modelUsuario->upUsuario(
            $id,
            $request->inNome,
            $request->inCpf,
            $request->inTelefone,
            $request->inEmail
        );
        
        $usuario = $this->objUsuario->find($_SESSION['dados']['id']);
        session()->flash('mensagem', "Os dados do usuário foram atualizados!");
        return view('times/cadastrar', compact('usuario'));
    }

    public function atualizarSenha($id)
    {
        $modelUsuario = new usuario();
        $usuario = $modelUsuario->lstUsuarioPorId($id);
        return view('usuario/atualizarSenha', compact('usuario'));
    }

    public function validaAlterarSenha(Request $request)
    {
        $modelUsuario = new usuario();
        $usuario = $modelUsuario->lstUsuarioPorId($request['hdUsuario']);

        if(password_verify($request['inSenhaAtual'], $usuario[0]['senha'])){
            if($request['inSenhaAtual'] == $request['inNovaSenha']){
                $msg = "A nova senha não pode ser igual a senha atual!";
            }else{
                if($request['inNovaSenha'] != $request['inConfirmaSenha']){
                    $msg = "As senhas não coenhecidem!";
                }else{
                    $modelUsuario->upSenha(
                        $request['hdUsuario'],
                        password_hash($request['inConfirmaSenha'], PASSWORD_DEFAULT)
                    );
                    session()->flash('mensagem', 'Senha atualizada com sucesso');
                    $usuario = $usuario = $this->objUsuario->find($request['hdUsuario']);
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
        $modelUsuario = new usuario();
        $usuarios = $modelUsuario->lstUsuario();

        return view('usuario/gerenciarTipo', compact('usuarios'));
    }

    public function validaTipoUsuario(Request $request)
    {
        $modelUsuario = new usuario();
        $modelUsuario->upTipo(
            $request['slUsuario'],
            $request['slTipo']
        );

        return redirect()->route('usuario.tipo');

    }

}

