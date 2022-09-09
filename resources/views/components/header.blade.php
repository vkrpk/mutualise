<header class="position-fixed w-100" style="z-index: 3">
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container">
          <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="logo">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-end">
                <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">Services</a></li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                            <span class="flag-icon flag-icon-fr"></span>&nbsp;Français
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">
                                <span class="flag-icon flag-icon-gb"></span>&nbsp;English
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" aria-expanded="false"data-bs-toggle="dropdown" href="#">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('profilIndex') }}">Mon compte</a>
                            <a class="dropdown-item" href="#">Mes accès</a>
                            <a class="dropdown-item" href="#">Ouvrir un ticket</a>
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
                                Se déconnecter
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </li>
                @endguest
                <li class="nav-item"><a class="nav-link active"
                    href="{{ request()->headers->get('referer') }}">← Retour</a></li>
                <li class="nav-item">
                    <a href="{{ route('cart.list') }}" class="nav-link">
                        <i class="fa-solid fa-cart-shopping"></i>
                        {{ Cart::getTotalQuantity()}}
                     </a>
                </li>
            </ul>
          </div>
        </div>
    </nav>
</header>
