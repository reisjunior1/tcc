@extends('times.tela.telas')

@section('parte')
	<?php
		$style = ($numeroTimes[0]['total']) >= $grupos[0]['numeroTimes'] ? "pointer-events: none" : null;
		$disabled = ($numeroTimes[0]['total']) >= $grupos[0]['numeroTimes'] ? "disabled" : null;
	?>
	<title>Visualizar Grupo</title>
	<script type="text/javascript" src="https://kryogenix.org/code/browser/sorttable/sorttable.js"></script>
	</head>
	<body>
		<div class="text-left mt-3 mb-4">
			@if(session('mensagem'))
				<div class="alert alert-danger text-center mt-4 mb-4 p-2 col-8 m-auto">
					<p>{{session('mensagem')}}</p>
				</div>
			@endif
		</div>

		@if(!is_null(Auth::user()) && Auth::user()->hasAnyRole(['AdminCampeonato', 'AdminGeral']))
			<div class="text-center mt-3 mb-4">
				<a
					style= "<?php echo $style ?>"
					href="{{ route("campeonato.adicionarTimeGrupo", ['idGrupo' => $idGrupo]) }}"
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
							@if(!is_null(Auth::user()) && Auth::user()->hasAnyRole(['AdminCampeonato', 'AdminGeral']))
								<th scope="col">Ação</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@foreach($times as $time)
							<tr>
								<th scope="row">{{$time['nome']}}</th>
								@if(!is_null(Auth::user()) && Auth::user()->hasAnyRole(['AdminCampeonato', 'AdminGeral']))
									<td>
										<form id="submit-form" action={{route("campeonato.apagaTimeGrupo")}} method='PUT' class="hidden">
											@csrf
											@method('PUT')
											<input type="hidden" id="hdGrupo" name="hdGrupo" value="{{$idGrupo}}">
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
				<label class="text-center">Não há times no grupo</label>
			@endif
		</div class="col-8 m-auto">


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
								<th scope="row">{{$arrayTimes[$tabela[$i]['time']]}}</th>
								<td> {{$tabela[$i]['pontos']}} </td>
								<td> {{$tabela[$i]['partidas']}} </td>
								<td> {{$tabela[$i]['vitorias']}} </td>
								<td> {{$tabela[$i]['empates']}} </td>
								<td> {{$tabela[$i]['derrotas']}} </td>
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
									<th scope="row">{{$arrayTimes[$tabela[$i]['time']]}}</th>
									<td> {{$tabela[$i]['pontos']}} </td>
									<td> {{$tabela[$i]['partidas']}} </td>
									<td> {{$tabela[$i]['vitorias']}} </td>
									<td> {{$tabela[$i]['empates']}} </td>
									<td> {{$tabela[$i]['derrotas']}} </td>
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
