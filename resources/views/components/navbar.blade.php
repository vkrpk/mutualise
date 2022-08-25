<nav class="nav nav-borders">
    <a class="nav-link {{ $route === 'profilIndex' ? "active" : ""}}" href="{{ route('profilIndex') }}">Profil</a>
    <a class="nav-link {{ $route === 'profilBilling' ? "active" : ""}}" href="{{ route('profilBilling') }}">Paiement</a>
    <a class="nav-link {{ $route === 'profilSecurity' ? "active" : ""}}" href="{{ route('profilSecurity') }}">Sécurité</a>
    <a class="nav-link {{ $route === 'profilNotifications' ? "active" : ""}}" href="{{ route('profilNotifications') }}">Notifications</a>
</nav>
