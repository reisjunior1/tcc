@extends('times.tela.telas')

@section('parte')
<title>Jogador</title>

	<div class="text-left mt-3 mb-4">
		@if(!empty($id))
			<form name="formEdit" id="formEdit" method="put" action="{{ route("jogador.edita", ['id' => $id, 'time' => $time]) }}">
				@method('PUT')
		@else
			<form name="formCadastro" id="formCadastro" method="post" action="{{route("jogador.salva")}}">
		@endif
		@csrf

	<!-- <form class="row g-3 conterner"  method="post"  action="{{url('cadastrojogador')}}"  > -->

		<div class="col-8 m-auto">
			<label for="nome" class="form-label">Nome:</label>
			<input
				type="text"
				class="text45Left form-control"
				id="inNome"
				name='inNome'
				value="{{$jogador[0]['nome'] ?? ''}}"
				placeholder="Nome"
				required
			>

			<label for="nome" class="form-label">Apelido:</label>
			<input
				type="text"
				class="text45Left form-control"
				id="inApelido"
				name='inApelido'
				value="{{$jogador[0]['apelido'] ?? ''}}"
				placeholder="Apelido"
				required
			>

			<label for="cpf" class="form-label">CPF:</label>
			<input
				type="cpf"
				class="text45Left form-control cpf"
				id="inCpf"
				name='inCpf'
				value="{{$jogador[0]['cpf'] ?? ''}}"
				placeholder="***.***.***-**"
				required
			>

			<label for="telefone" class="form-label">Telefone:</label>
			<input
				type="text"
				class="text45Left form-control telefone"
				id="inTelefone"
				name='inTelefone'
				value="{{$jogador[0]['telefone'] ?? ''}}"
				placeholder="( ) - ---- ----"
			>

			<label for="inData" class="form-label">Data de nacimento</label>
			<input
				type="date"
				class="text45Left form-control"
				name="inData"
				id="inData"
				value="{{$jogador[0]['nacimento'] ?? ''}}"
				placeholder="DD/MM/AAAA"
				required
			>
		</div>

		<div class="col-8 m-auto">
			<button type="submit" class="btn btn-primary">Salvar</button>
		</div>
	</form>

@endsection('parte')
