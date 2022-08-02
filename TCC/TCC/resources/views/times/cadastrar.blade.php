@extends('times.tela.telas')


@section('parte')
    <title>Cadastro</title>
  </head>
  <body>

<div class="conterner py-4">

<form class="row g-3">

<div class="col-12">
    <label for="nome" class="form-label">nome</label>
    <input type="text" class="form-control" id="nome" placeholder="nome">
  </div>
  <div class="col-md-6">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="inEmail">
  </div>
  <div class="col-md-6">
    <label for="senha" class="form-label">Senha</label>
    <input type="password" class="form-control" id="Senha">
  </div>
  <div class="col-12">
    <label for="endereco" class="form-label">Endereço</label>
    <input type="text" class="form-control" id="endereco" placeholder="Rua:..">
  </div>
  <div class="col-12">
    <label for="endereco" class="form-label">endereco 2</label>
    <input type="text" class="form-control" id="inendereco2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="col-md-6">
    <label for="cidade" class="form-label">Cidade</label>
    <input type="text" class="form-control" id="incidade">
  </div>
  <div class="col-md-4">
    <label for="inputState" class="form-label">State</label>
    <select id="inputState" class="form-select">
      <option selected>Choose...</option>
      <option>...</option>
    </select>
  </div>
  <div class="col-md-2">
    <label for="inputZip" class="form-label">Zip</label>
    <input type="text" class="form-control" id="inputZip">
  </div>
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Sign in</button>
  </div>
</form>



  </div>


   <form action=" POST">
    
   <label for="nome">Nome:</label>
      <input type="text" name="nome" id="nome" placeholder="Nome completo">
    </div>


   </form>
    
   @endsection