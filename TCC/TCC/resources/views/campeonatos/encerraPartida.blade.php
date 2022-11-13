@extends('times.tela.telas')

@section('parte')
	<title>Atualizar Senha</title>
  	</head>
  	<body>
		<form action={{route("campeonato.validaEncerrarPartida")}} method='PUT'>
  			@csrf
			<div class="conterner py-4">
				@if(session('mensagem'))
					<div class="alert alert-danger text-center mt-4 mb-4 p-2">
						<p>{{session('mensagem')}}</p>
					</div>
				@endif

				<div class="mx-auto" style="width: 800px;">
					<div class="col-md-6 campo">
						<?php $i =0; ?>
						<input type="hidden" id="hdPartida" name="hdPartida" value="{{$idPartida}}">
						<input type="hidden" id="hdTimeCasa" name="hdTimeCasa" value="{{$times[0]['id']}}">
						<input type="hidden" id="hdTimeVisitante" name="hdTimeVisitante" value="{{$times[1]['id']}}">

						<label for="slAcao{{$i}}" class="form-label">Ação:</label>
						<select name="slAcao{{$i}}"  id="slAcao{{$i}}" class="form-select">
							<option selected>Selecione...</option>
							@foreach($acoes as $acao)
								<option value= {{$acao['id']}}>{{$acao['descricao']}}</option>
							@endforeach
						</select>

						<label for="slTime{{$i}}" class="form-label">Time:</label>
						<select name="slTime{{$i}}"  id="slTime{{$i}}" class="form-select">
							<option selected>Selecione...</option>
							@foreach($times as $time)
								<option value= {{$time['id']}}>{{$time['nome']}}</option>
							@endforeach
						</select>

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
					<div class="col-md-1">
						<label for="code" class="text-left"></label><br>
						<button type="button" class="btn btn-success add-campo" id="add-campo"> + </button>
					</div>
					<br>
					<div class="col-12">
						<button type="submit" class="btn btn-primary">Finalizar</button>
					</div>
				</div>
			</div>
		</form>

	@endsection
