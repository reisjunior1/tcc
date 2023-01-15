@extends('times.tela.telas')

@section('parte')
	<title>Gerenciar Papeis</title>
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
						<option value=0 selected>Selecione...</option>
						@foreach($usuarios as $usuario)
							<option
								value= {{$usuario['id']}} {{isset($dados['slUsuario'])
                                            ? ($dados['slUsuario'] == $usuario['id'] ? 'selected' : '')
                                            : ''
                                        }}
							>{{$usuario['name']}}</option>
						@endforeach
					</select>

					<label for="slPapel" class="form-label">Papel:</label>
					<select name="slPapel"  id="slPapel" class="form-select">
						<option value=0 selected>Selecione...</option>
						@foreach($papeis as $papel)
							<option
								value= {{$papel['name']}} {{isset($dados['slPapel'])
                                            ? ($dados['slPapel'] == $papel['name'] ? 'selected' : '')
                                            : ''
                                        }}
							>{{$papel['name']}}</option>
						@endforeach
					</select>
				</div>

				<div class="col-6 m-auto">
					<button type="submit" class="btn btn-primary btn-margin-top">Dar Permissão</button>
				</div>
			</div>
		</form>
	@endsection
