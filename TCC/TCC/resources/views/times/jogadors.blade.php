@extends('times.tela.telas')

@section('parte')
<title>Jogador</title>

@if(!empty($usuario))
  <form class="row g-7 conterner" name="formEdit" id="formEdit" method="post" action="{{url("usuario/$usuario->id")}}">
  @method('PUT')

@else
  <form class="row g-7 conterner" name="formCadastro" id="formCadastro" method="post" action="{{url('cadastrojogador')}}"> 
@endif

<form class="row g-3 conterner"  method="post"  action="{{url('cadastrojogador')}}"  >

<div class="conterner py-4">
<div class="col-8">
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
  <div class="col-md-4">
  <label for="inData" class="form-label">Data de nacimento</label>
   <input type="date" class="form-control" name="inData" id="inData" value="{{isset($dados['inData']) ? $dados['inData'] : null}}" placeholder="DD/MM/AAAA">
   </div>
  <div class="col-md-4">
    <label for="email" class="form-label">Email:</label>
    <input type="email" class="form-control" id="inEmail" name='inEmail' value="{{$usuario->email ?? ''}}" placeholder="....@email.com">
  </div>

  <div class="col-12">
      <button type="submit" class="btn btn-primary">Salvar</button>
</div>
</form>
  </div> 
</div>
@endsection('parte')