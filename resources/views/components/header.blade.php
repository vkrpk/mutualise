<header class="position-fixed w-100" style="z-index: 3">
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container">
            <a class="navbar-brand me-0" href="{{ route('home') }}">
                <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-end">
                    <li class="nav-item"><a class="nav-link" href="{{ route('offers') }}">{{__("Offres")}}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('services.index') }}">Services</a></li>

                    @if (LaravelLocalization::getCurrentLocale() === "fr")
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle nav-link text-dedikam" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                <span><img class="image-drapeau" src="{{ Vite::asset('resources/images/fr.png') }}" alt="drapeau français"></span>
                                &nbsp;Français
                            </a>
                            <div class="dropdown-menu"><a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL("en", null, [], true) }}">
                                <span><img class="image-drapeau" src="{{ Vite::asset('resources/images/en.png') }}" alt="drapeau anglais"></span>
                                &nbsp;English</a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle nav-link text-dedikam" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                <span><img class="image-drapeau" src="{{ Vite::asset('resources/images/en.png') }}" alt="drapeau anglais"></span>
                                &nbsp;English
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL("fr", null, [], true) }}">
                                    <span><img class="image-drapeau" src="{{ Vite::asset('resources/images/fr.png') }}" alt="drapeau français"></span>
                                    &nbsp;Français
                                </a>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="https://www.dedikam.com">← {{__('Retour')}}</a></li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown d-flex flex-column align-items-end">
                            <a class="dropdown-toggle nav-link d-inline-flex align-items-center justify-content-center" aria-expanded="false"data-bs-toggle="dropdown" href="#">
                                {{ Auth::user()->name }}
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle overflow-hidden mx-1" style="max-width: 23px !important; max-height: 23px!important; height: 23px !important;">
                                    <img class="image-avatar" src="{{ Auth::user()->avatar !== '' ? asset('avatars_uploads/' . Auth::user()->avatar) : Vite::asset('resources/images/users/avatars/default.png') }}" alt="">
                                </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('profilIndex') }}">{{__('Mon compte')}}</a>
                                <a class="dropdown-item" href="{{ route('access.index') }}">{{__('Mes accès')}}</a>
                                {{-- <a class="dropdown-item" href="#">{{__('Ouvrir un ticket')}}</a> --}}
                                @if (Auth::user()->role_id === 1)
                                    <div class="dropdown-divider"></div>
                                    <span class="dropdown-header">Admin</span>
                                    <a class="dropdown-item" href="{{ url('admin') }}">Voyager : index</a>
                                    <a class="dropdown-item" href="{{ url('admin/users') }}">Voyager : users</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                    {{__('Logout')}}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cart.list') }}" class="nav-link">
                                <i class="fa-solid fa-cart-shopping"></i>
                                {{ Cart::getTotalQuantity() }}
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
