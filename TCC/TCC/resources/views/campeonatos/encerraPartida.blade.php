@extends('times.tela.telas')

@section('parte')
	<title>Encerrar Partida</title>
	</head>
	<body>
		<form action={{route("campeonato.validaEncerrarPartida")}} method='PUT'>
			@csrf
			<div class="text-center mt-3 mb-4">
				@if(session('mensagem'))
					<div class="alert alert-danger text-center mt-4 mb-4 p-2">
						<p>{{session('mensagem')}}</p>
					</div>
				@endif

				<div class="col-4 m-auto campo">
					<?php $i =0; ?>
					<input type="hidden" id="hdPartida" name="hdPartida" value="{{$idPartida}}">
					<input type="hidden" id="hdTimeCasa" name="hdTimeCasa" value="{{$times[0]['id']}}">
					<input type="hidden" id="hdTimeVisitante" name="hdTimeVisitante" value="{{$times[1]['id']}}">

					<label for="slAcao{{$i}}" class="form-label">Ação:</label>
					<select name="slAcao{{$i}}"  id="slAcao{{$i}}" class="form-select">
						<option selected value=0>Selecione...</option>
						@foreach($acoes as $acao)
							<option value= {{$acao['id']}}>{{$acao['descricao']}}</option>
						@endforeach
					</select>

					<label for="slTime{{$i}}" class="form-label">Time:</label>
					<select name="slTime{{$i}}"  id="slTime{{$i}}" class="form-select">
						<option selected value=0>Selecione...</option>
						@foreach($times as $time)
							<option value= {{$time['id']}}>{{$time['nome']}}</option>
						@endforeach
					</select>

					<label for="inNumero{{$i}}" class="form-label">Número Camisa*</label>
					<input
						type="number"
						class="form-control minutos"
						name="inNumero{{$i}}"
						id="inNumero{{$i}}"
						value="{{isset($dados['inNumero']) ? $dados['inNumero'] : null}}"
						placeholder="00"
					>

					<label for="inTempo{{$i}}" class="form-label">Minutos*</label>
					<input
						type="text"
						class="form-control minutos"
						name="inTempo{{$i}}"
						id="inTempo{{$i}}"
						value="{{isset($dados['inHora']) ? $dados['inHora'] : null}}"
						placeholder="Hora de início"
					>
				</div>
			</div>

			<div class="text-left col-4 m-auto">
				<label for="code" class="text-left"></label><br>
				<button type="button" class="btn btn-success add-campo" id="add-campo"> + </button>
			</div>
			<div class="text-center col-4 m-auto">
				<button type="submit" class="btn btn-primary btn-size-90-margin-top">Finalizar</button>
			</div>
		</div>
		</form>

	@endsection
