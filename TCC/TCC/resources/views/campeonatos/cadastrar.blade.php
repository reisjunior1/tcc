@extends('times.tela.telas')


@section('parte')
  <title>Cadastro</title>
  </head>
  <body>

<div class="conterner py-4">

<form class="row g-7">
  <div class="mx-auto" style="width: 800px; height: 500px;">
    <div class="col-md-6">
      <label for="inNomeCampeonato" class="form-label">Nome do Campeonato*</label>
      <input type="text" class="form-control" id="inNomeCampeonato" placeholder="Digite o nome do campeonato">
    </div>
    <br>
    <div class="col-md-6">
      <label for="slFormato" class="form-label">Formato*</label>
      <select id="slFormato" class="form-select">
        <option selected>Selecione...</option>
        <option value="PC">Pontos Corridos</option>
        <option value="CP">Copa</option>
        <option value="MM">Mata a mata</option>
      </select>
    </div>
    <br>
    <div class="col-12">
      <select id="slTime" select id="demo" multiple="multiple" class="form-select">
        @foreach($times as $time)
        <option value={{$time->id}}>{{$time->nome}}</option>
        @endforeach
      </select>
    </div>
    <br>
    <div class="col-12">
      <?php $value = 'Cadastrar'?> 
      <button type="submit" class="btn btn-success"><?php echo $value ?></button>
    </div>
  </div>

</form>



   @endsection
