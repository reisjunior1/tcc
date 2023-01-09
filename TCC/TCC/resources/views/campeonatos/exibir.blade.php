@extends('times.tela.telas')

@section('parte')
	<?php
		$style = ($numeroTimes[0]['total']) >= $campeonato[0]['numeroTimes'] ? "pointer-events: none" : null;
		$disabled = ($numeroTimes[0]['total']) >= $campeonato[0]['numeroTimes'] ? "disabled" : null;
	?>
	<title>Visualizar Campeonato</title>
	</head>

	<body>
		<div class="text-left mt-3 mb-4">
			@if(session('mensagem'))
				<div class="alert alert-danger text-center mt-4 mb-4 p-2 col-8 m-auto">
					<p>{{session('mensagem')}}</p>
				</div>
			@endif
			<div class="col-8 m-auto box">
				<label class="form-label">Nome: </label> {{$campeonato[0]['nome']}}
				<br>
				<label class="form-label">Formato: </label> {{$campeonato[0]['formato']}}

				<label class="form-label">Times Participantes: </label> {{$campeonato[0]['numeroTimes']}}
				<br>
				<label class="form-label">Perído:</label> {{$campeonato[0]['dataInicio']}}
				<label> a </label> {{$campeonato[0]['dataFim']}}
			</div>
		</div>

		@if(!is_null(Auth::user()) && Auth::user()->hasAnyRole(['AdminCampeonato']))
			<div class="text-center mt-3 mb-4">
				<a
					style= "<?php echo $style ?>"
					href="{{ route("campeonato.adicionarTime", ['idCampeonato' => $campeonato[0]['id']]) }}"
				>
					<button type="button " class="btn btn-success" <?php echo $disabled ?>>Adicionar Time</button>
				</a>
			</div>
		@endif

		<!-- Tabela que exibe os times participantes -->
		<div class="col-8 m-auto">
			@if(!empty($times))
				<table class="table text-center" style="overflow-x:auto;">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Time</th>
							<th scope="col">Nº de Jogadores</th>
							@if(!is_null(Auth::user()) && Auth::user()->hasAnyRole(['AdminCampeonato']))
								<th scope="col">Ação</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@foreach($times as $time)
							<tr>
								<th scope="row">{{$time['nome']}}</th>
								<td>{{!is_null($numeroJogadores) ? $numeroJogadores[$time['id']] : '0'}}</td>
								@if(!is_null(Auth::user()) && Auth::user()->hasAnyRole(['AdminCampeonato']))
									<td>
										<form
											id="submit-form"
											action={{route("campeonato.buscaJogadores")}}
											method='PUT'
											class="hidden"
										>
											@csrf
											@method('PUT')
											<input type="hidden" id="hdCampeonato" name="hdCampeonato" value="{{$campeonato[0]['id']}}">
											<input type="hidden" id="slTime" name="slTime" value="{{$time['id']}}">
											<input type="hidden" id="hdApagarDados" name="hdApagarDados" value="1">
											<button type="submit" class="btn btn-primary btn-size-90">Editar</button>
										</form>
								
										<form id="submit-form" action={{route("campeonato.apagaTimesCampeonato")}} method='PUT' class="hidden">
											@csrf
											@method('PUT')
											<input type="hidden" id="hdCampeonato" name="hdCampeonato" value="{{$campeonato[0]['id']}}">
											<input type="hidden" id="slTime" name="slTime" value="{{$time['id']}}">
											<input type="hidden" id="hdApagarDados" name="hdApagarDados" value="1">
											<button type="submit" class="btn btn-danger btn-size-90">Deletar</button>
										</form>
									</td>
								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<br>
				<label class="text-center">Não há times participando deste campeonato</label>
			@endif
		</div class="col-8 m-auto">

		@if (sizeof($ultimasPartidas) > 0 && sizeof($proximasPartidas) > 0)
			<div class="grid-container col-10 m-auto">
				<div class="grid-child list-group">
					<ul>
						<li class="list-group-item list-group-item-primary text-center"> Últimas Partidas</li>
						@foreach($ultimasPartidas as $ultima)
							<li class="list-group-item">
								{{$ultima['timeCasa']}} <b>{{$ultima['gols_time_casa']}}
								X {{$ultima['gols_time_visitante']}} </b> {{$ultima['timeVisitante']}}
							</li>
						@endforeach
					
						<?php $camp = $campeonato[0]['id']; ?>
						<a
							href="{{url("campeonato/$camp/partidas")}}"
							class="list-group-item list-group-item-action list-group-item-success text-center"
						>
							Ver Mais
						</a>
					</ul>
				</div>
				<div class="grid-child list-group">
					<ul>
						<li class="list-group-item list-group-item-primary text-center"> Próximas Partidas</li>
						@foreach($proximasPartidas as $proximas)
							<li class="list-group-item">{{$ultima['timeCasa']}} X {{$ultima['timeVisitante']}}</li>
						@endforeach
						<a
							href="{{url("campeonato/$camp/partidas")}}"
							class="list-group-item list-group-item-action list-group-item-success text-center"
						>
							Ver Mais
						</a>
					</ul>
				</div>
			</div>
		@endif

		<!-- Tabela Classificacao -->
		<div class = "col-10 m-auto" style="overflow-x:auto;">
			@if(!empty($tabela))
				<table class="table text-center">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Time</th>
							<th scope="col">Pontos</th>
							<th scope="col">Partidas</th>
							<th scope="col">Vitorias</th>
							<th scope="col">Empates</th>
							<th scope="col">Derrotas</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$aux = count($times) > 2 ? 2 : count($times);
						?>
						@for($i = 0; $i < $aux; $i++)
							<tr>
								<th scope="row">{{$times[$i]['nome']}}</th>
								<td> {{$tabela[$times[$i]['id']]['pontos']}} </td>
								<td> {{$tabela[$times[$i]['id']]['partidas']}} </td>
								<td> {{$tabela[$times[$i]['id']]['vitorias']}} </td>
								<td> {{$tabela[$times[$i]['id']]['empates']}} </td>
								<td> {{$tabela[$times[$i]['id']]['derrotas']}} </td>
							</tr>
						@endfor
						@if($i < count($times))
							<tbody class="labels" id="mainFrameOne"  display: contents;>
								<tr>
									<td colspan="6">
										<a onclick="naoExibir()" href="#">
											<label for="verMais">Ver Mais</label>
										</a>
										<input
											type="checkbox"
											name="verMais"
											id="verMais"
											data-toggle="toggle"
										>
									</td>
								</tr>
							</tbody>
						@endif
						<tbody class="hide" style="display: none">
							@for($i = $aux; $i < count($times); $i++)
								<tr>
									<th scope="row">{{$times[$i]['nome']}}</th>
									<td> {{$tabela[$times[$i]['id']]['pontos']}} </td>
									<td> {{$tabela[$times[$i]['id']]['partidas']}} </td>
									<td> {{$tabela[$times[$i]['id']]['vitorias']}} </td>
									<td> {{$tabela[$times[$i]['id']]['empates']}} </td>
									<td> {{$tabela[$times[$i]['id']]['derrotas']}} </td>
								</tr>
							@endfor
								<tr class="verMenos">
									<td colspan="6">
										<a onclick="exibir()" href="#">
											<label for="verMais">Ver Menos</label>
										</a>
										<input
											type="checkbox"
											name="verMais"
											id="verMenos"
											data-toggle="toggle"
										>
									</td>
								</tr>
						</tbody>
					</tbody>
				</table>
			@endif
		</div>

	@endsection