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
                    <form method="POST" action="{{ route('usuario.validaDado') }}">
                        @csrf

                        <input type="hidden" id="hdUsuario" name="hdUsuario" value={{$idUsuario}}>
                        <div class="row mb-3">
                            <p>Confirme os três primeiros digitos de seu CPF:</p>
                            <label for="cpf" class="col-md-4 col-form-label text-md-end">{{ __('3 primeiros digitos') }}</label>

                            <div class="col-md-6">
                                <input id="cpf" type="number" class="form-control" name="cpf" required autocomplete="telefone" autofocus>
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
