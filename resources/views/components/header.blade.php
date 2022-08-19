<header class="fixed-top">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button navbar-fixed-top bg-dedikam text-dedikam">
        <div class="container"><a class="navbar-brand" href="https://dedispace.dedikam.com/"><img
                    src="../../images/logo.png"></a>
            <div class="collapse navbar-collapse justify-content-end" id="navcol-1">
                <ul class="navbar-nav">
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
                        {{-- dedikam --}}
                        <li class="nav-item"><a class="nav-link active text-dedikam" href="#">← Retour</a></li>
                        <li class="nav-item"></li>
                        <li class="nav-item"></li>
                        <li class="nav-item"></li>
                        <li class="nav-item"><a class="nav-link text-dedikam" href="#">Services</a></li>
                        <li class="nav-item"></li>
                        <li class="nav-item dropdown"><a class="dropdown-toggle nav-link text-dedikam" aria-expanded="false"
                                data-bs-toggle="dropdown" href="#"><span
                                    class="flag-icon flag-icon-fr"></span>&nbsp;Français</a>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#"><span
                                        class="flag-icon flag-icon-gb"></span>&nbsp;English</a></div>
                        </li>
                        <li class="nav-item dropdown"><a class="dropdown-toggle nav-link text-dedikam" aria-expanded="false"
                                data-bs-toggle="dropdown" href="#">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">Mon compte</a><a
                                    class="dropdown-item" href="#">Mes accès</a><a class="dropdown-item"
                                    href="#">Ouvrir un ticket</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                    Se déconnecter
                                </a>
                            </div>
                        </li>
                        <li class="nav-item d-flex flex-fill"><a
                                class="nav-link btn btn-primary text-white font-weight-bold d-block px-2">Se connecter</a>
                        </li>
                        {{-- truc de base --}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
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
</header>
