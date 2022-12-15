@extends('times.tela.telas')

@section('parte')
	<title>Cadastro</title>
	</head>
	<body>
		<hr>
		<h2 class="text-center">Login</h2>
		<hr>

		@if(session('mensagem'))
			<div class="alert alert-success text-center mt-4 mb-4 p-2">
				<p>{{session('mensagem')}}</p>
			</div>
		@endif

		<form method = "POST" action="{{route('login.entrar')}}" name="formLogar" placeholder="">
		@csrf
			<div class="text-left mt-3 mb-4">

				<div class="col-6 m-auto">
					<label for="username">Usuário</label>
					<input type="text" class="form-control" placeholder="E-mail ou telefone" id="username" name= "username">

					<label for="password">Senha</label>
					<input type="password" class="form-control" placeholder="Senha" id="password" name="password">
				</div>

				<div class="text-center col-4 m-auto">
					<p>
						<label class="control control--checkbox mb-0"><span class="caption">Lembrar de mim</span>
							<input type="checkbox" checked="checked"/>
						</label>
					</p>
					
					<div class="control__indicator"></div>
					<p>
						<span class="ml-auto"><a href="#" class="forgot-pass">Esqueceu sua Senha</a></span>
					</p>
					<p>
						<span class="ml-auto">
							<a href="{{ route('usuario.cadastrar') }}" class="cadastrar">Cadastrar-se</a>
						</span>
					</p>
					<input type="submit" value="Log In" class="btn btn-block btn-primary">
				</div>>
			</div>
		</form>
	@endsection
