
@extends('times.tela.telas')

@section('parte')
	<title>Adicionar Time ao Campeonato</title>
	</head>
	<body>
	<form action={{route("campeonato.validaSalvaTimeGrupo")}} method='PUT'>
		@csrf
		@if(session('mensagem'))
			<div class="alert alert-danger text-center mt-4 mb-4 p-2 col-8 m-auto">
				<p>{{session('mensagem')}}</p>
			</div>
		@endif
		<div class="col-10 m-auto">
			<div input-group class="card">
                <div class="card-header text-left">{{  __('Adicionar Time') }}</div>
				<div class="col-6 mx-auto">
					<input type="hidden" id="hdGrupo" name="hdGrupo" value="{{$grupo[0]['id']}}">
					<label for="slTime" class="form-label">Selecione um Time*</label>
					<select name="slTime"  id="slTime" class="form-select select20em">
						<option value="0" selected>Selecione...</option>
						@foreach($times as $time)
							<option value= {{$time['id']}}>{{$time['nome']}}</option>
						@endforeach
					</select>
				</div>

				<div class="text-center mt-3 mb-4">
					<button type="submit" class="btn btn-primary">Adicionar</button>
				</div>
			</div>
		</div>
	</form>

@endsection
