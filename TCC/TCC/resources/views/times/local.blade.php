@extends('times.tela.telas')



@section('parte')
    <title>Cadastro - Local</title>
  </head>
  <body>
<div class="container" >
<div class="conterner py-4">

<form class="row g-3"  method="put"  action={(route("time.local"))}>
  <form class="row g-3"  method="post"  action="{{url('local')}}"  >
   @csrf

   <div class="col-12">
    <label for="nome" class="form-label">Nome :</label>
    <input type="text" class="form-control" id="inNome" name='inNome'   placeholder="Nome">
  </div>
  <div class="col-md-2" >
    <label for="cep" class="form-label">CEP:</label>
    <input type="text" class="form-control" id="incep">
  </div>
  <div class="col-4">
    <label for="endereco" class="form-label">Endereço:</label>
    <input type="text" class="form-control" id="inendereco" placeholder="Rua:..">
  </div>
  <div class="col-4">
    <label for="complemento" class="form-label">Complemento:</label>
    <input type="text" class="form-control" id="incomplemento" placeholder="Apartamento, quadra...">
  </div>
  
  <div class="col-md-4">
    <label for="cidade" class="form-label">Cidade:</label>
    <input type="text" class="form-control" id="incidade">
  </div>
  <div class="col-md-4">
    <label for="estado" class="form-label">Estado:</label>
    <select id="slestado" class="form-select">
      <option selected>...</option>
      <option>...</option>
      <option>MG</option>
      <option>ES</option>
    </select>


  <div class="col-12"> <p></p>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button class="btn btn-danger">Cancelar</button>
    </div>
</form>



  </div>

   
   </div>
   @endsection




