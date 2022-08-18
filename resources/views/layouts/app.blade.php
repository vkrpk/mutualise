<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dedikam</title>
    <!-- Fonts -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts/ionicons.min.css') }}" rel="stylesheet">
    <script>@vite(['resources/scss/app.scss'])</script>
    
</head>

<body>
    <x-header/>
    {{-- <div id="app">
        <header class="fixed-top">
            <nav
                class="navbar navbar-light navbar-expand-md navigation-clean-button navbar-fixed-top bg-dedikam text-dedikam">
                <div class="container"><a class="navbar-brand" href="/"><img
                            src="{{ asset('img/logo.png') }}" alt=""></a><button data-bs-toggle="collapse"
                        class="navbar-toggler" data-bs-target="#navcol-1">
                        <div id="nav-icon"><span></span><span></span><span></span></div>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navcol-1">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link active text-dedikam"
                                    href="https://www.dedikam.com/">← @lang('Retour')</a></li>
                            <li class="nav-item"></li>
                            <li class="nav-item"></li>
                            <li class="nav-item"></li>
                            <li class="nav-item"><a class="nav-link text-dedikam" href="#">Services</a></li>
                            <li class="nav-item"></li>
                            @if (App::isLocale('fr'))
                                <li class="nav-item dropdown"><a class="dropdown-toggle nav-link text-dedikam"
                                        aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                            class="flag-icon flag-icon-fr"></span>&nbsp;Français</a>
                                    <div class="dropdown-menu"><a class="dropdown-item" href="/locale/en"><span
                                                class="flag-icon flag-icon-gb"></span>&nbsp;English</a></div>
                                </li>
                            @else
                                <li class="nav-item dropdown"><a class="dropdown-toggle nav-link text-dedikam"
                                        aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                            class="flag-icon flag-icon-gb"></span>&nbsp;English</a>
                                    <div class="dropdown-menu"><a class="dropdown-item" href="/locale/fr"><span
                                                class="flag-icon flag-icon-fr"></span>&nbsp;Français</a></div>
                                </li>
                            @endif
                            @guest
                                <li class="nav-item d-flex flex-fill"><a
                                        class="nav-link btn btn-primary text-white font-weight-bold d-block px-2"
                                        href="{{ route('login') }}">@lang('Se connecter')</a>
                                </li>
                                <li><a class="nav-link" href="{{ route('register') }}">@lang('Créer un compte')</a>
                                </li>
                            @else
                                @if (session()->get('cart'))
                                    <li class="nav-item"><span><a class="nav-link" href="{{ route('cart') }}"><i
                                                    class="bi bi-cart-fill fs-5 text-dedikam"></i><span
                                                    class="position-relative translate-middle badge rounded-pill bg-secondary fw-light"
                                                    style="top:-0.2rem;left:.4rem;">{{ session()->get('cart') ? '1' : '' }}</span></a></span>
                                    </li>
                                @endif
                                <li class="nav-item dropdown"><a class="dropdown-toggle nav-link text-dedikam"
                                        aria-expanded="false" data-bs-toggle="dropdown"
                                        href="#">{{ Auth::user()->name }}</a>
                                    <div class="dropdown-menu"><a class="dropdown-item" href="{{route('profile')}}">@lang('Mon compte')</a><a
                                            class="dropdown-item" href="{{ route('member_accesses.index') }}">@lang('Mes accès')</a><a class="dropdown-item" href="{{route('myorders')}}">@lang('Mes commandes')</a>
                                            <a class="dropdown-item" href="#">@lang('Ouvrir un ticket')</a>
                                        @if(Auth::user()->user_type=="admin")
                                        <div class="dropdown-divider"></div>
                                        <span class="dropdown-header">Admin</span>
                                        <a class="dropdown-item" href="{{ route('orders.index') }}">Gestion des commandes</a>
                                        <a class="dropdown-item" href="{{ route('users.index') }}">Gestion des comptes</a>
                                        @endhasrole
                                        <div class="dropdown-divider"></div><a class="dropdown-item"
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault();$('#logout-form').submit();">
                                            @lang('Se déconnecter')
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>

        <footer class="footer-basic mt-auto py-1 bg-dedikam text-dedikam fixed-bottom">
            <div class="social"></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="https://www.dedikam.com/contact/" target="_blank">Contact</a></li>
                <li class="list-inline-item social pb-0"><a href="https://www.facebook.com/DediKam" target="_blank"><i
                            class="icon ion-social-facebook"></i></a></li>
                <li class="list-inline-item social pb-0"><a href="https://twitter.com/DediKam" target="_blank"><i
                            class="icon ion-social-twitter"></i></a></li>
            </ul>
            <p class="copyright">Dedikam © 2008 - 2022</p>
        </footer>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts') --}}
    <h1>Todo</h1>
    <x-footer/>
</body>

</html>
