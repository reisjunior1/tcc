@extends('times.tela.telas')

@section('parte')
<title>Jogador</title>

	<div class="text-left mt-3 mb-4">
		@if(!empty($id))
			<form name="formEdit" id="formEdit" method="put" action="{{ route("arbrito.edita", ['id' => $id]) }}">
				@method('PUT')
		@else
			<form name="formCadastro" id="formCadastro" method="post" action="{{route("arbrito.salva")}}">
		@endif
		@csrf

		<div class="col-8 m-auto">
			<label for="nome" class="form-label">Nome:</label>
			<input
				type="text"
				class="text45Left form-control"
				id="inNome"
				name='inNome'
				value="{{$arbrito[0]['nome'] ?? ''}}"
				placeholder="Nome Sobrenome"
				required
			>

			<label for="cpf" class="form-label">CPF:</label>
			<input
				type="cpf"
				class="text45Left form-control cpf"
				id="inCpf"
				name='inCpf'
				value="{{$arbrito[0]['cpf'] ?? ''}}"
				placeholder="***.***.***-**"
				required
			>

			<label for="telefone" class="form-label">Telefone:</label>
			<input
				type="text"
				class="text45Left form-control telefone"
				id="inTelefone"
				name='inTelefone'
				value="{{$arbrito[0]['telefone'] ?? ''}}"
				placeholder="( ) - ---- ----"
			>

            <label for="email" class="form-label">Email:</label>
			<input
				type="mail"
				class="text45Left form-control inEmail"
				id="inEmail"
				name='inEmail'
				value="{{$arbrito[0]['email'] ?? ''}}"
			>

		</div>

		<div class="col-8 m-auto">
			<button type="submit" class="btn btn-primary">Salvar</button>
		</div>
	</form>

@endsection('parte')
