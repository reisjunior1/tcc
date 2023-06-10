@extends('times.tela.telas')

@section('parte')
	<title>@if(isset($campeonato)) Editar @else Cadastrar @endif</title>
	</head>
	<body>
		<div class="text mt-3 mb-4">
			@if(session('mensagem'))
                <div class="alert alert-danger text-center mt-4 mb-4 p-2">
                    <p>{{session('mensagem')}}</p>
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
					<label for="inNome" class="form-label">Nome do Grupo*</label>
					<input
					type="text"
					name="inNome"
					id="inNome"
					value="{{$dados['inNome'] ?? ''}}"
					class="form-control"
					placeholder="Digite o nome do grupo"
					>
				</div>

				<div class="col-6 mx-auto">
					<label for="inNumeroTimes" class="form-label">Número de Times Participantes*</label>
					<input
						type="number"
						class="form-control"
						name="inNumeroTimes"
						id="inNumeroTimes"
						value="{{$dados['inNumeroTimes'] ?? ''}}"
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