@extends('times.tela.telas')


@section('parte')
    <title>Cadastro</title>
  </head>
  <body>
<div class="container">
<div class="conterner py-4">

<form class="row g-3"  method="post"  action="{{url('campeonato')}}"  >

<div class="col-12">
    <label for="nome" class="form-label">Nome Completo:</label>
    <input type="text" class="form-control" id="innome" name='innome'   placeholder="Nome/Sobrenome">
  </div>
  <div class="col-md-6">
    <label for="cpf" class="form-label">CPF:</label>
    <input type="cpf" class="form-control" id="incpf" name='incpf'   placeholder="***.***.***-**">
  </div>
  <div class="col-md-6">
    <label for="telefone" class="form-label">Telefone:</label>
    <input type="text" class="form-control" id="intelefone" name='intelefone' placeholder="( ) - ---- ----">
  </div>


  <div class="col-md-6">
    <label for="email" class="form-label">Email:</label>
    <input type="email" class="form-control" id="inemail" name='inemail' placeholder="....@email.com">
  </div>
  <div class="col-md-4">
  <label for="tipo" class="form-label">Tipo:</label>
    <input type="text" class="form-control" id="intipo" name='intipo'  placeholder="Informe o tipo do usuario">



  </div>
  <div class="col-md-6" >
    <label for="senha" class="form-label">Senha:</label>
    <input type="text" class="form-control" id="insenha" name='insenha'  placeholder="Crie uma senha">
    <input type="text" class="form-control" id="insenha2" name='insenha2'  placeholder="Confime a senha">
  </div>




  <!--<div class="col-12">
    <label for="endereco" class="form-label">Endereço:</label>
    <input type="text" class="form-control" id="inendereco" placeholder="Rua:..">
  </div>
  <div class="col-12">
    <label for="complemento" class="form-label">Complemento:</label>
    <input type="text" class="form-control" id="incomplemento" placeholder="Apartamento, quadra...">
  </div>
  <div class="col-md-2">
    <label for="cep" class="form-label">CEP:</label>
    <input type="text" class="form-control" id="incep">
  </div>
  <div class="col-md-6">
    <label for="cidade" class="form-label">Cidade:</label>
    <input type="text" class="form-control" id="incidade">
  </div>
  <div class="col-md-4">
    <label for="estado" class="form-label">Estado:</label>
    <select id="slestado" class="form-select">
      <option selected>...</option>
      <option>...</option>
    </select>
  </div>
  
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Aceitar os termos de serviços
        <a href="#">Termos</a>
      </label>
    </div>
  </div>-->
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Salvar</button>
  </div>
</form>



  </div>


   
   </div>
   @endsection