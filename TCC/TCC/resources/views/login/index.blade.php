@extends('times.tela.telas')


@section('parte')
  <title>Cadastro</title>
  </head>
  <body>

  <hr> <h2 class="text-center">Login</h2> <hr>
  @if(session('mensagem'))
    <div class="alert alert-success text-center mt-4 mb-4 p-2">
        <p>{{session('mensagem')}}</p>
    </div>
  @endif
<div class="text-center mt-3 mb-4">
    <div class="col-4 m-auto">
        <form method = "POST" action="{{route('login.entrar')}}" name="formLogar" placeholder="">
            @csrf
            <div class="form-group first">
                <label for="username">Usuário</label>
                <input type="text" class="form-control" placeholder="E-mail ou telefone" id="username" name= "username">
              </div>
              <div class="form-group last mb-3">
                <label for="password">Senha</label>
                <input type="password" class="form-control" placeholder="Senha" id="password" name="password">
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Lembrar de mim</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                  <br>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Esqueceu sua Senha</a></span> 
              </div>

              <input type="submit" value="Log In" class="btn btn-block btn-primary">
        </form>
    </div>
</div>

   @endsection
