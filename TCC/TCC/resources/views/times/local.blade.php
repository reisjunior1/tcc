@extends('times.tela.telas')

@section('parte')
<title>Cadastro - Local</title>
</head>
<body>

	@if(isset($errors) && count($errors)>0)
		<div class="alert alert-danger text-center mt-4 mb-4 p-2">
			@foreach($errors->all() as $erro)
				{{$erro}}<br>
			@endforeach
		</div>
	@endif
	<div class="text-left mt-3 mb-4" >
		<div class="col-8 m-auto">
			@if(isset($id))
			<form class="row g-3"  method="put"  action="{{ route("local.edita", ['id' => $id]) }}">
			@else
				<form class="row g-3"  method="post"  action="{{route("local.salva")}}"  >
			@endif

			@csrf
				<label for="nome" class="form-label">Nome :</label>
				<input
					type="text"
					class="text45Left form-control"
					id="inNome"
					name='inNome'
					placeholder="Nome"
					value="{{$local[0]['nome'] ?? ''}}"
					required
				>

				<label for="cep" class="form-label">CEP:</label>
				<input
					type="text"
					class="text45Left form-control cep"
					id="inCep" name='inCep'
					placeholder="00000-000"
					value="{{$local[0]['cep'] ?? ''}}"
					required
				>

				<label for="endereco" class="form-label">Endereço:</label>
				<input
					type="text"
					class="text45Left form-control"
					id="inEndereco"
					name="inEndereco"
					placeholder="Rua:.."
					value="{{$local[0]['endereco'] ?? ''}}"
					required
				>

				<label for="cidade" class="form-label">Numero:</label>
				<input
					type="text"
					class="text45Left form-control"
					id="inNumero"
					name="inNumero"
					value="{{$local[0]['numero'] ?? ''}}"
					required
				>

				<label for="cidade" class="form-label">Bairro:</label>
				<input
					type="text"
					class="text45Left form-control"
					id="inBairro"
					name="inBairro"
					value="{{$local[0]['bairro'] ?? ''}}"
					required
				>

				<label for="complemento" class="form-label">Complemento:</label>
				<input
					type="text"
					class="text45Left form-control"
					id="inComplemento"
					name="inComplemento"
					placeholder="Apartamento, quadra..."
					value={{$local[0]['complemento'] ?? ''}}
				>

				<label for="cidade" class="form-label">Cidade:</label>
				<input
					type="text"
					class="text45Left form-control"
					id="inCidade"
					name="inCidade"
					value="{{$local[0]['cidade'] ?? ''}}"
					required
					>

				<label for="estado" class="form-label">Estado:</label>
				<select id="slEstado" name="slEstado" class="text45Left form-select">
					<option selected>Selecione...</option>
					<option value = 'MG'
						{{isset($local[0]['estado'])
						? ($local[0]['estado'] == 'MG' ? 'selected' : '')
						: ''}}
					>MG</option>
					<!--<option value = 'ES'
						{{isset($local[0]['estado'])
						? ($local[0]['estado'] == 'ES' ? 'selected' : '')
						: ''}}
					>ES</option>-->
					required
				</select>


			<div input-group>
				<button type="submit" class="btn btn-primary">Salvar</button>
				<button class="btn btn-danger">Cancelar</button>
			</div>
		</form>
	</div>
@endsection
