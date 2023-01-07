<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/jquery-form/form@4.3.0/dist/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

<script src="{{asset('vendor/jquery/jquery-3.6.1.min.js')}}"></script>
<script src="{{asset('vendor/jquery-mask/jquery.mask.min.js')}}"></script>
<script src="{{asset('js/index.js')}}"></script>

<?php 
  if(!isset($acoes)){
    $acoes = array();
  }
  if(!isset($times)){
    $times = array();
  }
?>
<script>
    $('.hora').mask('00:00:00');
    $('.cpf').mask('000.000.000-00');
    $('.telefone').mask('(00) 00000-0000');
    $('.minutos').mask('000:00', {reverse: true});
    
</script>

<script>
var i=1;
$("#add-campo").click(function(){
  $( ".campo" ).append('<div class="teste" id="teste'+i+'"><label for="slAcao'+i+'" '
  + 'class="form-label">Ação:</label><select name="slAcao'+i
  +'"  id="slAcao'+i+'" class="form-select"><option selected>Selecione...</option>@foreach($acoes as $acao): var_dump(@acao); <option value= {{$acao["id"]}}>{{$acao["descricao"]}}</option> @endforeach </select><label for="slTime'+i+'" class="form-label">Time:</label><select name="slTime'+i+'"  id="slTime'+i+'" class="form-select"><option selected>Selecione...</option>@foreach($times as $time)<option value= {{$time["id"]}}>{{$time["nome"]}}</option>@endforeach</select><label for="inTempo'+i+' class="form-label">Minutos*</label><input type="text" class="form-control minutos" name="inTempo'+i+'" id="inTempo'+i+'" placeholder="Minutos"><button type="button" class="btn-apagar btn btn-danger btn-margin-top" id="'+i+'">-</button>');
  $('.minutos').mask('000:00', {reverse: true} );
  
  i++;
});

$('form').on('click', '.btn-apagar', function () {
	var button_id = $(this).attr("id");
	$('#teste' + button_id + '').remove();
});
</script>

<script>
  $('form').on('click', '.btn-remover-acao', function () {
    var button_id = $(this).attr("id");
	  $('#enventoCadastrado' + button_id + '').remove();
});
</script>

<script>
  $(document).ready(function() {
    $('[data-toggle="toggle"]').change(function(){
      $(this).parents().next('.hide').toggle();
    });
    document.getElementById("element").style.display = "none";
  });
</script>

<script>
  function naoExibir() {
	  document.getElementById("mainFrameOne").style.display="none";
  }
</script>

<script>
  function exibir() {
	  document.getElementById("mainFrameOne").style.display="contents";
  }
</script>

</body>
</html>
