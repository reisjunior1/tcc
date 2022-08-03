@extends('times.tela.telas')


@section('parte')
  <title>Cadastro</title>
  </head>
  <body>

<div class="conterner py-4">

<form class="row g-7" name="formCadastro" id="formCadastro" method="post" action="{{url('campeonato')}}">
  @csrf
  <div class="mx-auto" style="width: 800px;">
    <div class="col-md-6">
      <label for="inNomeCampeonato" class="form-label">Nome do Campeonato*</label>
      <input type="text" name="inNomeCampeonato" id="inNomeCampeonato" class="form-control" placeholder="Digite o nome do campeonato">
    </div>
    <br>
    <div class="col-md-6">
      <label for="slFormato" class="form-label">Formato*</label>
      <select name="slFormato"  id="slFormato" class="form-select">
        <option selected>Selecione...</option>
        <option value="PC">Pontos Corridos</option>
        <option value="CP">Copa</option>
        <option value="MM">Mata a mata</option>
      </select>
    </div>
    <br>
    <div class="col-12">
      <label for="inDataInicio" class="form-label">Periodo*</label>
      <div class="col-3">
        <input type="date" class="form-control" name="inDataInicio" id="inDataInicio" placeholder="DD/MM/AAAA">
        <label class="form-label">a</label>
        <input type="date" class="form-control" name="inDataFim" id="inDataFim" placeholder="DD/MM/AAAA">
      </div>
    </div>
    <br>
    <div class="col-md-6">
    <label for="inNumeroTimes" class="form-label">Número de Times Participantes*</label>
    <input type="number" class="form-control" name="inNumeroTimes" id="inNumeroTimes" placeholder="Digite o Número de times participantes">
    </div>
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
