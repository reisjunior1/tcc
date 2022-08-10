@extends('times.tela.telas')


@section('parte')
  <title>@if(isset($campeonato)) Editar @else Cadastrar @endif</title>
  </head>
  <body>

<div class="conterner py-4">
<form class="row g-7" name="formInsereirTime" id="formInsereirTime"> 

  @csrf
  <div class="mx-auto" style="width: 800px;">
    <div class="col-md-6">
      <label for="slTime" class="form-label">Selecione um Time*</label>
      <select name="slTime"  id="slTime" class="form-select">
      <option selected>Selecione...</option>
      @foreach($times as $time)
      <option value= {{$time['id']}}>{{$time['nome']}}</option>
        @endforeach
        </select>
    </div>
    <br>
    <div class="col-12">
      <button type="submit" class="btn btn-success">Adicionar</button>
    </div>
  </div>

</form>



   @endsection
