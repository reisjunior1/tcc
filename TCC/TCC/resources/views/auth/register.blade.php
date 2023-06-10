@extends('times.tela.telas')

@section('parte')
<div class="container">
    <div class="row justify-content-center">
    @if(session('mensagem'))
	<div class="alert alert-danger text-center mt-4 mb-4 p-2">
		<p>{{session('mensagem')}}</p>
	</div>
	@endif        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Novo Usuário') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('usuario.salvar') }}">
                        @csrf

                        <div class="row mb-3">
                            <label
                                for="name"
                                class="col-md-4 col-form-label text-md-end">
                                    {{ __('Nome Completo') }}
                            </label>

                            <div class="col-md-6">
                                <input
                                    id="name"
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}"
                                    required autocomplete="name"
                                    autofocus
                                >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label
                                for="cpf"
                                class="col-md-4 col-form-label text-md-end">
                                    {{ __('CPF') }}
                                </label>

                            <div class="col-md-6">
                                <input
                                    id="cpf"
                                    type="text"
                                    class="form-control cpf"
                                    name="cpf" value="{{ old('cpf') }}"
                                    required autocomplete="cpf"
                                >

                                @error('cpf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label
                                for="email"
                                class="col-md-4 col-form-label text-md-end">
                                    {{ __('E-mail') }}
                                </label>

                            <div class="col-md-6">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}"
                                    autocomplete="email"
                                >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label
                                for="telefone"
                                class="col-md-4 col-form-label text-md-end">
                                    {{ __('Telefone') }}
                                </label>

                            <div class="col-md-6">
                                <input
                                    id="telefone"
                                    type="text"
                                    class="form-control telefone"
                                    name="telefone" value="{{ old('telefone') }}"
                                    autocomplete="telefone"
                                >

                                @error('telefone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label
                                for="password"
                                class="col-md-4 col-form-label text-md-end"
                            >
                                {{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password"
                                >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label
                                for="password-confirm"
                                class="col-md-4 col-form-label text-md-end"
                            >
                                {{ __('Confirmar Senha') }}</label>

                            <div class="col-md-6">
                                <input
                                    id="password-confirm"
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    required autocomplete="new-password"
                                >
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Salvar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
