@extends('times.tela.telas')


@section('parte')
  <title>@if(isset($campeonato)) Editar @else Cadastrar @endif</title>
  </head>
  <body>

<div class="conterner py-4">
@if(isset($errors) && count($errors)>0)
    <div class="class= text-danger text-center mt-4 mb-4 p-2 ">
        @foreach($errors->all() as $erro)
            {{$erro}}<br>
        @endforeach
    </div>
@endif

@if(isset($campeonato))
  <form class="row g-7" name="formEdit" id="formEdit" method="post" action="{{url("campeonato/$campeonato->id")}}">
    @method('PUT')
@else
  <form class="row g-7" name="formCadastro" id="formCadastro" method="post" action="{{url('campeonato')}}"> 
@endif

  @csrf
  <div class="mx-auto" style="width: 800px;">
    <div class="col-md-6">
      <label for="inNomeCampeonato" class="form-label">Nome do Campeonato*</label>
      <input type="text" name="inNomeCampeonato" id="inNomeCampeonato" value="{{$campeonato->nome ?? ''}}" class="form-control" placeholder="Digite o nome do campeonato">
    </div>
    <br>
    <div class="col-md-6">
      <label for="slFormato" class="form-label">Formato*</label>
      <select name="slFormato"  id="slFormato" class="form-select">
        <option selected>Selecione...</option>
        <option value="PC" {{isset($campeonato) ? ($campeonato->formato == 'PC' ? 'selected' : '') : ''}}>Pontos Corridos</option>
        <option value="CP" {{isset($campeonato) ? ($campeonato->formato == 'CP' ? 'selected' : '') : ''}}>Copa</option>
        <option value="MM" {{isset($campeonato) ? ($campeonato->formato == 'MM' ? 'selected' : '') : ''}}>Mata a mata</option>
      </select>
    </div>
    <br>
    <div class="col-12">
      <label for="inDataInicio" class="form-label">Periodo*</label>
      <div class="col-3">
        <input type="date" class="form-control" name="inDataInicio" id="inDataInicio" value="{{$campeonato->dataInicio ?? ''}}" placeholder="DD/MM/AAAA">
        <label class="form-label">a</label>
        <input type="date" class="form-control" name="inDataFim" id="inDataFim" value="{{$campeonato->dataFim ?? ''}}" placeholder="DD/MM/AAAA">
      </div>
    </div>
    <br>
    <div class="col-md-6">
    <label for="inNumeroTimes" class="form-label">Número de Times Participantes*</label>
    <input type="number" class="form-control" name="inNumeroTimes" id="inNumeroTimes" value="{{$campeonato->numeroTimes ?? ''}}" placeholder="Digite o Número de times participantes">
    </div>
    <br>
    <div class="col-12">
      <?php $value = isset($campeonato) ? 'Editar' : 'Cadastrar'?> 
      <button type="submit" class="btn btn-success"><?php echo $value ?></button>
    </div>
  </div>

</form>



   @endsection
