<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Nomisoft</title>
    <link rel="icon" type="image/jpg" href="img/ic.jpg  "/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
   

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- SweetAlert -->
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<style>
   .bg-nav {
   background-color: #E61313;
   }
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-nav shadow-md">
            <div class="container">
                <img src="{{ asset('img/logosi.jpg') }}" style=" width: 65px; height: 80px;">

                <a class=" navbar-brand text-white " style="font-size: 40px; " href="{{ url('/') }} ">   Universidad del Valle  </a>

               
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav-tab" role="tablist">
        <!-- Left Side Of Navbar -->
        <ul class="nav nav-tabs">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <!--<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>-->
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <!--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>-->
                    </li>
                @endif
            @else

        <!--validacion de usuarios por el rol secretaria -->
            @if ( Auth::user()->rol==='S' )
            <!--(Route::has('homeSecretaria'))-->

           <!-- <div><center><h1>Secretaria</h1></center></div> -->


              <div> 
                <li class="nav-item dropdown">     
                        <a class="nav-link text-white" style="font-size: 20px;" href="{{ route('porteros.listar') }}">
                            {{ __('Porteros') }}
                        </a>
                </li>
            </div>
            <div>
                <a class="nav-link text-white" style="font-size: 20px;" href="{{ route('turnos.listar') }}">
                        {{ __('Turnos') }}
                </a>
            </div>
            <div>
                <a class="nav-link text-white" style="font-size: 20px;" href="{{ route('recargos.mostrar') }}">
                        {{ __('Recargos') }}
                </a>
            </div>
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" style="font-size: 20px;" href="#" role="button" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Cerrar Sesión') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
            </div>
                    <!--validacion de usuarios por el rol portero-->
            
                @elseif (Auth::user()->rol==='P')

                <div> 
                    <li class="nav-item">     
                        <a class="nav-link text-white" style="font-size: 20px;" href="{{ route('horarios.portero') }}">
                            {{ __('Consultar Horario') }}
                        </a>
                    </li>
                </div>

                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" style="font-size: 20px;" href="#" role="button" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}<span class="caret"></span>
                    </a>

                   <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Cerrar Sesión') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" 
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
            

                    <!--validacion de usuarios por el rol administrador -->
                @else

                    <div> 
                    <li class="nav-item">     
                        <a class="nav-link text-white" style="font-size: 20px;" href="{{ route('porteros.listar') }}">
                            {{ __('Porteros') }}
                        </a>
                    </li>
                </div>
                <div>
                
                    <a class="nav-link text-white" style="font-size: 20px;" href="{{ route('turnos.listar') }}">
                            {{ __('Turnos') }}
                    </a>
                </div>
                <div>
                    <a class="nav-link text-white" style="font-size: 20px;" href="{{ route('horarios.listar') }}">
                            {{ __('Horarios') }}
                        </a>
                </div>
                <div>
                    <a class="nav-link text-white" style="font-size: 20px;" href="{{ route('recargos.mostrar') }}">
                            {{ __('Recargos') }}
                    </a>
                </div>
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" style="font-size: 20px;" href="#" role="button" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}<span class="caret"></span>
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Cerrar Sesión') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>

<!-- Footer -->
<footer class="page-footer font-small special-color-dark pt-4">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Derechos Reservados A&J Soft
    
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
