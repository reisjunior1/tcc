@extends('times.tela.telas')

@section('parte')
	@if($dadosPartida[0]['status'] == 1)
		<title>Editar Resultado Partida</title>
	@else
		<title>Encerrar Partida</title>
	@endif
	</head>
	<body>
		@if($dadosPartida[0]['status'] == 1)
			<form action={{route("campeonato.validaAlterarResultado")}} method='PUT'>
		@else
			<form action={{route("campeonato.validaEncerrarPartida")}} method='PUT'>
		@endif
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

					<h2 class="text-center">{{$times[0]['nome']}} X {{$times[1]['nome']}}</h2>
					<hr>
					<div class="col-6 mx-auto">
						<label for="inGolsTimeCasa" class="form-label">Gols do Time {{$times[0]['nome']}}*</label>
                            <input
                                type="number"
                                class="form-control"
                                name="inGolsTimeCasa"
                                id="inGolsTimeCasa"
                                value="{{isset($dadosPartida[0]['gols_time_casa']) ? $dadosPartida[0]['gols_time_casa'] : null}}"
								required
                            >
                    </div>
					<div class="col-6 mx-auto">
						<label for="inGolsTimeVisitante" class="form-label">Gols do Time {{$times[1]['nome']}}*</label>
                            <input
                                type="number"
                                class="form-control"
                                name="inGolsTimeVisitante"
                                id="inGolsTimeVisitante"
                                value="{{isset($dadosPartida[0]['gols_time_visitante']) ? $dadosPartida[0]['gols_time_visitante'] : null}}"
								required
							>
                    </div>
				</div>
				<div input-group class="my-auto mx-auto">
					<button type="submit" class="btn btn-success btn-size-90-10-margin">Salvar</button>
				</div>
		</form>

	@endsection
