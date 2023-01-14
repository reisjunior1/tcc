@extends('times.tela.telas')

@section('parte')

<title>Meu Perfil</title>
</head>
<body>
	@if(isset($errors) && count($errors)>0)
	<div class="class= text-danger text-center mt-4 mb-4 p-2 ">
		@foreach($errors->all() as $erro)
		{{$erro}}<br>
		@endforeach
	</div>
	@endif
	
	@if(session('mensagem'))
	<div class="alert alert-success text-center mt-4 mb-4 p-2">
		<p>{{session('mensagem')}}</p>
	</div>
	@endif
	
	<div class="text-left mt-3 mb-4">
		@if(!empty($usuario))
			<form class="row g-7" name="formEdit" id="formEdit" method="post" action="{{url("usuario/$usuario->id")}}">
		@method('PUT')

		@else
			<form class="row g-7" name="formCadastro" id="formCadastro" method="post" action="{{url('usuario')}}">
		@endif

			@csrf
				<div class="col-8 m-auto">
					<label for="nome" class="form-label">Nome Completo:</label>
					<input
						type="text"
						class="text45Left form-control"
						id="inNome"
						name='inNome'
						value="{{trim($usuario->name) ?? ''}}"
						placeholder="Nome Sobrenome"
					>

					<label for="cpf" class="form-label">CPF:</label>
					<input
						type="cpf"
						class="text45Left form-control cpf"
						id="inCpf"
						name='inCpf'
						value="{{$usuario->cpf ?? ''}}"
						placeholder="CPF"
					>

					<label for="telefone" class="form-label">Telefone:</label>
					<input
						type="text"
						class="text45Left form-control telefone"
						id="inTelefone"
						name='inTelefone'
						value="{{$usuario->telefone ?? ''}}"
						placeholder="( ) - ---- ----"
					>

					<label for="email" class="form-label">Email:</label>
					<input
						type="email"
						class="text45Left form-control"
						id="inEmail"
						name='inEmail'
						value="{{$usuario->email ?? ''}}"
						placeholder="exemplo@mail.com"
					>

				<?php if(empty($usuario)): ?>
					<div class="col-md-6" >
					<label for="senha" class="form-label">Senha:</label>
					<input type="text" class="form-control" id="inSenha" name='inSenha'  placeholder="Crie uma senha">
					<input type="text" class="form-control" id="inSenha2" name='inSenha2'  placeholder="Confime a senha">
					</div>
				<?php endif; ?>

				<?php if(!empty($usuario)): ?>
					<p>
						<span class="ml-auto">
							<a
								href="{{ route('usuario.atualizarSenha', ['idUsuario' => $usuario->id]) }}"
								class="atualizarSenha"
							>
								Atualizar Senha
							</a>
						</span>
					</p>
				<?php endif; ?>

				<div class="btn-size-160">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>

			@if(!empty($usuario))
				<form class="row g-7" id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
					@csrf
					<div class="btn-size-160">
						<button type="submit" class="btn btn-danger">Sair</button>
					</div>
				</form>
			@endif
	@endsection
