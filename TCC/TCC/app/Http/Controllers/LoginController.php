<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\usuario;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->objUsuario = new usuario();
    }

    public function index()
    {
        if (session_status() !== PHP_SESSION_ACTIVE ){
            session_start();
        }
       $usuario = [];
        if(!empty($_SESSION)){
            
            $usuario = $this->objUsuario->find($_SESSION['dados']['id']);
            return view('times/cadastrar', compact('usuario'));
        }
        return view('login/index');
    }

    public function entrar(Request $request)
    {
        // Define uma variável para testar o validador
        $input = $request['username'];
        
        // Faz a verificação usando a função
        if($this->validaEmail($input)) {
            $modelUsuario = new usuario();
            $usuario = $modelUsuario->lstUsuarioPorEmail($input);
        } else {
            if($this->validaTelefone($input)){
                $modelUsuario = new usuario();
                $usuario = $modelUsuario->lstUsuarioPorTelefone($input);
            }else{
                session()->flash('mensagem', 'Informe um e-mail ou telefone válido.');
                return view('login/index');
            }
        }
        if(empty($usuario)){
            session()->flash('mensagem', 'Usuário não encontrado. Verifique os dados.');
                return view('login/index');
        }else{
            if(password_verify($request['password'], $usuario[0]['senha'])){
                Session::put('id', $usuario[0]['id']);
                Session::put('nome', $usuario[0]['nome']);
                Session::put('email', $usuario[0]['email']);
                Session::put('telefone', $usuario[0]['telefone']);
                Session::put('tipo', $usuario[0]['tipo']);

                if (session_status() !== PHP_SESSION_ACTIVE ){
                    session_start();
                    $_SESSION["dados"]=$usuario[0];
                    return view('times.paginainicial');
                }
            }else{
                session()->flash('mensagem', 'Usuário ou senha incorreto. Verifique os dados.');
                return view('login/index');
            }
        }
    }

    // Define uma função que poderá ser usada para validar e-mails usando regexp
    public function validaEmail($email) {
        $conta = "/^[a-zA-Z0-9\._-]+@";
        $domino = "[a-zA-Z0-9\._-]+.";
        $extensao = "([a-zA-Z]{2,4})$/";
        
        $pattern = $conta.$domino.$extensao;
        
        if(preg_match($pattern, $email, $matches)){
            return true;
        }else{
            return false;
        }
    }

    function validaTelefone($telefone){
        $telefone= trim(str_replace('/', '', str_replace(' ', '', str_replace('-', '', str_replace(')', '', str_replace('(', '', $telefone))))));
    
        $regexTelefone = "/^[0-9]{11}$/";
    
        //$regexCel = '/[0-9]{2}[6789][0-9]{3,4}[0-9]{4}/'; // Regex para validar somente celular
        if (preg_match($regexTelefone, $telefone)) {
            return true;
        }else{
            return false;
        }
    }

}
