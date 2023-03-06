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
            dd('sair');
            session_start();
            unset($_SESSION);
            session_destroy();
        }
        
        return redirect()->route('PaginaInicial');

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
        $dados['slUsuario'] = $request->slUsuario;
        $dados['slPapel'] = $request->slPapel;

        $modelUser = new User();
        $usuarios = $modelUser->ltsTodosUsuario();
        $papeis = \Spatie\Permission\Models\Role::all();

        if ($dados['slUsuario'] != 0 && $dados['slPapel'] != 0) {
            $user = $modelUser->lstDadosUsuarioPorId($dados['slUsuario']);
            if ($user[0]->hasAnyRole([$dados['slPapel']])) {
                session()->flash('mensagem', 'O usuário já possui este papel!');
            } else {
                session()->flash('mensagem', 'Papel cadastrado ao usuário com sucesso!');
                $user[0]->assignRole($dados['slPapel']);
            }
        } else {
            session()->flash('mensagem', 'Selecione um usuário e um papel!');
        }
        return view('usuario/gerenciarTipo', compact('usuarios', 'papeis', 'dados'));

    }

    public function pesquisarPapel(Request $request, $pesquisar = null, $recuperaDados = null)
    {
        $modelUsuario = new User();
        $usuarios = $modelUsuario->ltsTodosUsuario();
        $papeis = \Spatie\Permission\Models\Role::all();

        $dados['slUsuario'] = $request->slUsuario;
        $dados['slPapel'] = $request->slPapel;

        if ($recuperaDados) {
            $arrayDados = unserialize(base64_decode($recuperaDados));
            $dados['slUsuario'] = $arrayDados['slUsuario'];
            $dados['slPapel'] = $arrayDados['slPapel'];
        }


        if ($pesquisar && ($dados['slUsuario'] != 0 || $dados['slPapel'] != 0)) {
            if ($dados['slUsuario'] != 0 && $dados['slPapel'] == 0) {
                $objUser = \App\Models\User::find($dados['slUsuario']);
                $objPapeis = $objUser->getRoleNames();

                $arrayUsuer[0] = json_decode(json_encode($objUser), true);
            }

            if ($dados['slUsuario'] == 0 && $dados['slPapel'] != 0) {
                $nome = $dados['slPapel'];
                $objUser = User::whereHas(
                    "roles",
                    function ($x) use ($nome) { $x->where("name", $nome); }
                )->get();
                $objPapeis = [$dados['slPapel']];

                $arrayUsuer = json_decode(json_encode($objUser), true);
            }

            if ($dados['slUsuario'] != 0 && $dados['slPapel'] != 0) {
                $objPapeis = null;
                $objUser = \App\Models\User::find($dados['slUsuario']);
                $aux = $objUser->getRoleNames();
                foreach ($aux as $a) {
                    if ($a == $dados['slPapel']) {
                        $objPapeis[] = $a;
                    }
                }
                $arrayUsuer[0] = json_decode(json_encode($objUser), true);
            }
            $arrayPapeis = json_decode(json_encode($objPapeis), true);

            $i = 0;

            if(!is_null($arrayPapeis)) {
                foreach ($arrayUsuer as $u) {
                    foreach ($arrayPapeis as $p) {
                        $arrayTabela[$i]['usuarioId'] = $u['id'];
                        $arrayTabela[$i]['usuario'] = $u['name'];
                        $arrayTabela[$i]['papel'] = $p;
                        $i++;
                    }
                }
            }
            $arrayDados = base64_encode(serialize($dados));

        }
        //dd($arrayTabela);
        if (isset($arrayTabela)) {
            return view(
                'usuario/pesquisarPapelUsuario',
                compact('usuarios', 'papeis', 'arrayTabela', 'dados', 'arrayDados')
            );
        }

        return view('usuario/pesquisarPapelUsuario', compact('usuarios', 'papeis', 'dados'));
    }

    public function removePapel($idUsuario, $papel, $parametros)
    {
        $modelUser = new User();
        $user = $modelUser->lstDadosUsuarioPorId($idUsuario);
        $user[0]->removeRole($papel);

        return redirect()->route('usuario.pesquisarPapel', [
            'pesquisar' => 1,
            'recuperarDados' => $parametros,
        ]);
    }

    public function recuperarSenha()
    {
        return view('usuario/recuperarSenha');
    }

    public function validaEmailTelefone(Request $request)
    {
        $modelUsuario = new User();
        $email = $modelUsuario->lstDadosUsuarioPorEmail($request->telefone);
        $telfone = $modelUsuario->lstDadosUsuarioPorTelefone(montaTelefone($request->telefone));
        
        if (empty($email) && empty($telfone)) {
            session()->flash('mensagem', 'Usuário não encontrado!');
            return view('usuario/recuperarSenha');
        } else {
            $idUsuario = !empty($email) ? $email[0]['id'] : $telfone[0]['id'];
            return view('usuario/verificaDado', compact('idUsuario'));
        }
    }

    public function validaDado(Request $request)
    {
        $modelUsuario = new User();
        $usuario = $modelUsuario->lstDadosUsuarioPorId($request->hdUsuario);

        if (substr($usuario[0]->cpf, 0, 3) == $request->cpf) {
            return redirect()->route('usuario.novaSenha',['idUsuario' => $request->hdUsuario]);
        } else {
            session()->flash('mensagem', 'Usuário não encontrado!');
            return view('usuario/recuperarSenha');
        }
    }

    public function novaSenha($idUsuario)
    {
        return view('usuario/novaSenha', compact('idUsuario'));
    }

    public function validaNovaSenha(Request $request)
    {
        $modelUsuario = new User();
        $usuario = $modelUsuario->lstDadosUsuarioPorId($request['hdUsuario']);
        
        if ($request['inNovaSenha'] != $request['inConfirmaSenha']) {
                $msg = "As senhas não coenhecidem!";
        } else {
            $modelUsuario->updSenha(
                $request['hdUsuario'],
                password_hash($request['inConfirmaSenha'], PASSWORD_DEFAULT)
            );
            session()->flash('mensagem', 'Senha atualizada com sucesso');
            $usuario = $usuario[0];
            
            return redirect()->route('login');
        }
        session()->flash('mensagem', $msg);
        return view('usuario/recuperarSenha', compact('usuario'));
    }
}

