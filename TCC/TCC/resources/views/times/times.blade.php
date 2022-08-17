@extends('times.tela.telas')



@section('parte')
    <title>Cadastro - Time</title>
  </head>
  <body>
<div class="container" >
<div class="conterner py-4">

<form class="row g-3"  action=" POST">

<div class="col-12">
    <label for="nometime" class="form-label">Nome do Time:</label>
    <input type="text" class="form-control" id="isnometime" placeholder="NomeTime">
  </div>
  <div class="col-md-6">
    <label for="sigla" class="form-label">Sigla:</label>
    <input type="sigla" class="form-control" id="insigla"  placeholder=" Siglado Time">
  </div>
  <div class="col-md-6">
    <label for="telefonetime" class="form-label">Telefone de Contato:</label>
    <input type="text" class="form-control" id="intelefonetime"  placeholder="( ) - ---- ----">
  </div>

  <div class="col-md-6">
    <label for="emailtime" class="form-label">Email:</label>
    <input type="emailtime" class="form-control" id="inEmailtime"  placeholder="....@email.com">
  </div>

  <div>
   <!-- 
  </div>
  <div class="col-md-6">
    <label for="responsavel" class="form-label">Responsável:</label>
    <input type="text" class="form-control" id="inresponsavel"  placeholder="Nome do Responsavel">
  </div>
  <div class="col-md-6">
    <label for="cpfresp" class="form-label">CPF:</label>
    <input type="cpfresp" class="form-control" id="incpfesp"  placeholder="***.***.***-**">
  </div>

  </div>
-->

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
    <label for="estado" class="form-label">Estado:</label>
    <select id="slestado" class="form-select">
      <option selected>...</option>
      <option>...</option>
    </select>
  <div class="col-md-6">
    <label for="cidade" class="form-label">Cidade:</label>
    <input type="text" class="form-control" id="incidade">
  </div>

  <div class="col-12"> <p></p>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button class="btn btn-danger">Cancelar</button>
    </div>
</form>



  </div>

   
   </div>
   @endsection




