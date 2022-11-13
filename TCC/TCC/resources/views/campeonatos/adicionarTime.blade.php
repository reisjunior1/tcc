
@extends('times.tela.telas')

@section('parte')
	<title>@if(isset($campeonato)) Editar @else Cadastrar @endif</title>
	</head>
  	<body>
	<form action={{route("campeonato.buscaJogadores")}} method='PUT'>
  		@csrf
		<div class="conterner py-4">
  			<div class="mx-auto" style="width: 800px;">
    			<div class="col-md-6">
      				<input type="hidden" id="hdCampeonato" name="hdCampeonato" value="{{$campeonato[0]->id}}">
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
      				<button type="submit" class="btn btn-primary">Próximo</button>
    			</div>
  			</div>
		</div>
	</form>

@endsection
