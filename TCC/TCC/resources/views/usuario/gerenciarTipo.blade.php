@extends('times.tela.telas')

@section('parte')
	<title>Atualizar Senha</title>
	</head>
	<body>
		<form action={{route("usuario.validaTipoUsuario")}} method='PUT'>
		@csrf
			<div class="text-left mt-3 mb-4">
				@if(session('mensagem'))
					<div class="alert alert-danger text-center mt-4 mb-4 p-2">
						<p>{{session('mensagem')}}</p>
					</div>
				@endif

				<div class="col-6 m-auto">
					<label for="slUsuario" class="form-label">Usuário:</label>
					<select name="slUsuario"  id="slUsuario" class="form-select">
						<option selected>Selecione...</option>
						@foreach($usuarios as $usuario)
							<option value= {{$usuario['id']}}>{{$usuario['nome']}}</option>
						@endforeach
					</select>

					<label for="slTipo" class="form-label">Tipo:</label>
					<select name="slTipo"  id="slTipo" class="form-select">
						<option selected>Selecione...</option>
						<option value='UC'>Usuário Comum</option>
						<option value='AT'>Administrador Time</option>
						<option value='AC'>Administrador Campeonato</option>
					</select>
				</div>

				<div class="col-6 m-auto">
					<button type="submit" class="btn btn-primary btn-margin-top">Finalizar</button>
				</div>
			</div>
		</form>
	@endsection
