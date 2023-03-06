<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color">

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    >
    <link rel="stylesheet" href=" /style.css" >
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('json/manifest.json') }}" rel="manifest" >
    <link rel="apple-touch-icon" href="images/logo192.png">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('PaginaInicial') }}">Início</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('local.index') }}">Local</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"   href="{{ route('time.index') }}" >  Times</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="{{ route('jogador.index') }}"  > Jogador</a>
          </li>
          @if(!is_null(Auth::user()) && Auth::user()->hasAnyRole(['AdminGeral']))
		      <li class="nav-item">
            <a class="nav-link"  href="{{ route('arbrito.index') }}">Arbitragem</a>
          </li>
		      @endif
          <li class="nav-item">
            <a class="nav-link"  href="{{ route('campeonato.index') }}"> Campeonato</a>
          </li>
          <li class="nav-item">
            <?php
              $texto = !empty($_SESSION) ? 'Perfil' : 'Login';
            ?>
            @guest
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            @else
              <a class="nav-link" href="{{ route('login.perfil') }}"  v-pre> {{'Perfil'}}</a>
            @endguest
          </li>

      @if(!is_null(Auth::user()) && Auth::user()->hasAnyRole(['AdminGeral']))
		  <li class="nav-item">
            <a class="nav-link"  href="{{ route('usuario.pesquisarPapel') }}"> Gerenciar Usuários</a>
          </li>
		  @endif

        </ul>
          <!--<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">-->
            @guest
              <a class="nav-link" href="{{ route('login') }}">
              <button class="btn btn-outline-success" type="button">Entrar</button>
              </a>
            @else
            <form class="row" id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
              <a class="nav-link" href="{{ route('usuario.sair') }}">
                <button class="btn btn-outline-success" type="submit">Sair</button>
              </a>
				    </form>
              
            @endguest
      </div>
    </div>
  </nav>
</header>

<main>

 @yield('parte')


  <!-- FOOTER -->
  <footer class="container">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>&copy; <?= date('Y') ?> UFOP, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
  </footer>
</main>



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
    $('.cep').mask('00000-000');
    
</script>

<script>
var i=1;
$("#add-campo").click(function(){
  $( ".campo" ).append('<div class="teste" id="teste'+i+'"><label for="slAcao'+i+'" '
  + 'class="form-label">Ação:</label><select name="slAcao'+i
  +'"  id="slAcao'+i+'" class="form-select"><option selected>Selecione...</option>@foreach($acoes as $acao): var_dump(@acao); <option value= {{$acao["id"]}}>{{$acao["descricao"]}}</option> @endforeach </select><label for="slTime'+i+'" class="form-label">Time:</label><select name="slTime'+i+'"  id="slTime'+i+'" class="form-select"><option selected>Selecione...</option>@foreach($times as $time)<option value= {{$time["id"]}}>{{$time["nome"]}}</option>@endforeach</select><label for="inNumero'+i+' class="form-label">Número Camisa*</label><input type="number" class="form-control minutos" name="inNumero'+i+'" id="inNumero'+i+'" placeholder="00"><label for="inTempo'+i+' class="form-label">Minutos*</label><input type="text" class="form-control minutos" name="inTempo'+i+'" id="inTempo'+i+'" placeholder="Minutos"><button type="button" class="btn-apagar btn btn-danger btn-margin-top" id="'+i+'">-</button>');
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
