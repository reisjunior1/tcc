@extends('times.tela.telas')

@section('parte')
	<title>@if(isset($campeonato)) Editar @else Cadastrar @endif</title>
	</head>
	<body>
		<div class="text mt-3 mb-4">
			@if(isset($errors) && count($errors)>0)
				<div class="alert alert-danger text-center mt-4 mb-4 p-2">
					@foreach($errors->all() as $erro)
						{{$erro}}<br>
					@endforeach
				</div>
			@endif

			@if(isset($partida))
                <form
                    method = "PUT"
                    action="{{ route("campeonato.editarGrupo", ['idPartida' => $partida[0]['id']]) }}" name="formBusca"
                >
            @else
                <form
                    method = "PUT"
                    action="{{ route("campeonato.salvarGrupo", ['idCampeonato' => $idCampeonato]) }}" name="formBusca"
                >
            @endif


			@csrf
			<div class="col-10 m-auto">
			<div input-group class="card">
                <div class="card-header text-left">{{ (isset($campeonato)) ? 'Editar' : 'Cadastrar'}}</div>

				<div class="col-6 mx-auto">
					<label for="inNome" class="form-label">Nome do Campeonato*</label>
					<input
					type="text"
					name="inNome"
					id="inNome"
					value="{{$campeonato->nome ?? ''}}"
					class="form-control text20em"
					placeholder="Digite o nome do grupo"
					>
				</div>

				<div class="col-6 mx-auto">
					<label for="inNumeroTimes" class="form-label">Número de Times Participantes*</label>
					<input
						type="number"
						class="form-control text20em"
						name="inNumeroTimes"
						id="inNumeroTimes"
						value="{{$campeonato->numeroTimes ?? ''}}"
						placeholder="Digite o Número de times participantes"
					>
				</div>

				<div class="text-center mt-3 mb-4">
					<?php $value = isset($campeonato) ? 'Editar' : 'Cadastrar'?>
					<button type="submit" class="btn btn-success"><?php echo $value ?></button>
				</div>
			</div>
	</form>

@endsection