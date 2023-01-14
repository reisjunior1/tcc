
@extends('times.tela.telas')

@section('parte')
	<title>@if(isset($campeonato)) Editar @else Cadastrar @endif</title>
	</head>
	<body>
	<form action={{route("campeonato.buscaJogadores")}} method='PUT'>
		@csrf
		<div class="col-10 m-auto">
			<div input-group class="card">
                <div class="card-header text-left">{{  __('Adicionar Time') }}</div>
				<div class="col-6 mx-auto">
					<input type="hidden" id="hdCampeonato" name="hdCampeonato" value="{{$campeonato[0]->id}}">
					<label for="slTime" class="form-label">Selecione um Time*</label>
					<select name="slTime"  id="slTime" class="form-select select20em">
						<option selected>Selecione...</option>
						@foreach($times as $time)
						<option value= {{$time['id']}}>{{$time['nome']}}</option>
						@endforeach
					</select>
				</div>

				<div class="text-center mt-3 mb-4">
					<button type="submit" class="btn btn-primary">Próximo</button>
				</div>
			</div>
		</div>
	</form>

@endsection
