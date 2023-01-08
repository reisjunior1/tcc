@extends('times.tela.telas')

@section('parte')
	<title>Atualizar Senha</title>
	</head>
	<body>
		@if(isset($errors) && count($errors)>0)
		<div class="class= text-danger text-center mt-4 mb-4 p-2 ">
			@foreach($errors->all() as $erro)
			{{$erro}}<br>
			@endforeach
		</div>
		@endif
		<form action={{route("usuario.validaAlterarSenha")}} method='PUT'>
		@csrf
			<div class="text-left mt-3 mb-4">

				@if(session('mensagem'))
					<div class="alert alert-danger text-center mt-4 mb-4 p-2">
						<p>{{session('mensagem')}}</p>
					</div>
				@endif

				<div class="col-6 m-auto">
					<input type="hidden" id="hdUsuario" name="hdUsuario" value="{{$usuario[0]['id']}}">
					<label for="inSenhaAtual" class="form-label">Digite sua sennha atual:</label>
					<input
						type="password"
						class="form-control"
						id="inSenhaAtual"
						name='inSenhaAtual'
						placeholder="Senha Atual"
					>

					<label for="inNovaSenha" class="form-label">Digite uma nova senha:</label>
					<input
						type="password"
						class="form-control"
						id="inNovaSenha"
						name='inNovaSenha'
						placeholder="Nova Senha"
					>

					<label for="inConfirmaSenha" class="form-label">Confirme a nova senha:</label>
					<input
						type="password"
						class="form-control"
						id="inConfirmaSenha"
						name='inConfirmaSenha'
						placeholder="Confirme a Senha"
					>
				</div>

				<div class="col-6 m-auto">
					<button type="submit" class="btn btn-primary btn-margin-top">Alterar</button>
				</div>
			</div>
		</form>
	@endsection
