@extends('times.tela.telas')

@section('parte')
<title>Jogador</title>

	<div class="text-left mt-3 mb-4">
		@if(!empty($usuario))
			<form name="formEdit" id="formEdit" method="post" action="{{url("usuario/$usuario->id")}}">
				@method('PUT')
		@else
			<form name="formCadastro" id="formCadastro" method="post" action="{{url('cadastrojogador')}}">
		@endif

	<!-- <form class="row g-3 conterner"  method="post"  action="{{url('cadastrojogador')}}"  > -->

		<div class="col-8 m-auto">
			<label for="nome" class="form-label">Nome Completo:</label>
			<input
				type="text"
				class="text45Left form-control"
				id="inNome"
				name='inNome'
				value="{{$usuario->nome ?? ''}}"
				placeholder="Nome Sobrenome"
			>

			<label for="cpf" class="form-label">CPF:</label>
			<input
				type="cpf"
				class="text45Left form-control cpf"
				id="inCpf"
				name='inCpf'
				value="{{$usuario->cpf ?? ''}}"
				placeholder="***.***.***-**"
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

			<label for="inData" class="form-label">Data de nacimento</label>
			<input
				type="date"
				class="text45Left form-control"
				name="inData"
				id="inData"
				value="{{isset($dados['inData']) ? $dados['inData'] : null}}"
				placeholder="DD/MM/AAAA"
			>

			<label for="email" class="form-label">Email:</label>
			<input
				type="email"
				class="text45Left form-control"
				id="inEmail"
				name='inEmail'
				value="{{$usuario->email ?? ''}}"
				placeholder="....@email.com"
			>
		</div>

		<div class="col-8 m-auto">
			<button type="submit" class="btn btn-primary">Salvar</button>
		</div>
	</form>

@endsection('parte')
