@extends('times.tela.telas')

@section('parte')

<title>Cadastro</title>
  </head>
  <body>
<div class="container">
<div class="conterner py-4">
  <?php //var_dump($usuario->cpf); die(); ?>
@if(isset($errors) && count($errors)>0)
    <div class="class= text-danger text-center mt-4 mb-4 p-2 ">
        @foreach($errors->all() as $erro)
            {{$erro}}<br>
        @endforeach
    </div>
@endif

@if(session('mensagem'))
    <div class="alert alert-success text-center mt-4 mb-4 p-2">
        <p>{{session('mensagem')}}</p>
    </div>
@endif

@if(!empty($usuario))
  <form class="row g-7" name="formEdit" id="formEdit" method="post" action="{{url("usuario/$usuario->id")}}">
  @method('PUT')

@else
  <form class="row g-7" name="formCadastro" id="formCadastro" method="post" action="{{url('usuario')}}"> 
@endif

<form class="row g-3"  method="post"  action="{{url('usuario')}}"  >

@csrf
<div class="col-12">
  <?php //var_dump($usuario); ?>
    <label for="nome" class="form-label">Nome Completo:</label>
    <input type="text" class="form-control" id="inNome" name='inNome' value="{{$usuario->nome ?? ''}}"  placeholder="Nome/Sobrenome">
  </div>
  <div class="col-md-6">
    <label for="cpf" class="form-label">CPF:</label>
    <input type="cpf" class="form-control" id="inCpf" name='inCpf' value="{{$usuario->cpf ?? ''}}" placeholder="***.***.***-**">
  </div>
  <div class="col-md-6">
    <label for="telefone" class="form-label">Telefone:</label>
    <input type="text" class="form-control" id="inTelefone" name='inTelefone' value="{{$usuario->telefone ?? ''}}" placeholder="( ) - ---- ----">
  </div>


  <div class="col-md-6">
    <label for="email" class="form-label">Email:</label>
    <input type="email" class="form-control" id="inEmail" name='inEmail' value="{{$usuario->email ?? ''}}" placeholder="....@email.com">
  </div>
  <div class="col-md-4">
  <label for="tipo" class="form-label">Tipo:</label>
    <input type="text" class="form-control" id="inTipo" name='inTipo'  placeholder="Informe o tipo do usuario">
  </div>
  
  <?php if(empty($usuario)): ?>
    <div class="col-md-6" >
      <label for="senha" class="form-label">Senha:</label>
      <input type="text" class="form-control" id="inSenha" name='inSenha'  placeholder="Crie uma senha">
      <input type="text" class="form-control" id="inSenha2" name='inSenha2'  placeholder="Confime a senha">
    </div>
  <?php endif; ?>
  
  <?php if(!empty($usuario)): ?>
    <div class="col-md-6" >
      <p>
        <span class="ml-auto"><a href="{{ route('usuario.atualizarSenha', ['idUsuario' => $usuario->id]) }}" class="atualizarSenha">Atualizar Senha</a></span> 
      </p>
    </div>
  <?php endif; ?>

  <div class="col-12">
      <button type="submit" class="btn btn-primary">Salvar</button>
  </div>
</form>
<?php if(!empty($usuario)): ?>
  <a href="{{route("usuario.sair")}}">
    <button class="btn btn-danger">Sair</button>
  </a>
<?php endif; ?>

@endsection