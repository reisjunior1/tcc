@extends('times.tela.telas')

@section('parte')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('mensagem'))
                <div class="alert alert-success text-center mt-4 mb-4 p-2">
                    <p>{{session('mensagem')}}</p>
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Esqueci minha senha') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('usuario.validaEmailTelefone') }}">
                        @csrf

                        <div class="row mb-3">
                            <p>Digite seu e-mail ou telefone utilizados no sistema:</p>
                            <label for="telefone" class="col-md-4 col-form-label text-md-end">{{ __('E-mail ou Telefone') }}</label>

                            <div class="col-md-6">
                                <input id="telefone" type="text" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ old('telefone') }}" required autocomplete="telefone" autofocus>

                                @error('userId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Próximo') }}
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
