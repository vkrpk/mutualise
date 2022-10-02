<nav class="nav nav-borders justify-content-evenly justify-content-sm-start" id="profile-nav">
    @php
        $linkStyle = "mx-2 mx-sm-3";
    @endphp
    <a class="nav-link {{$linkStyle}} {{ $route === 'profilIndex' ? "active" : ""}}" href="{{ route('profilIndex') }}">{{__('Profile')}}</a>
    {{-- <a class="nav-link {{$linkStyle}} {{ $route === 'profilBilling' ? "active" : ""}}" href="{{ route('profilBilling') }}">{{__('Paiement')}}</a> --}}
    <a class="nav-link {{$linkStyle}} {{ $route === 'profilSecurity' ? "active" : ""}}" href="{{ route('profilSecurity') }}">{{__('Sécurité')}}</a>
    {{-- <a class="nav-link {{$linkStyle}} {{ $route === 'profilNotifications' ? "active" : ""}}" href="{{ route('profilNotifications') }}">Notifications</a> --}}
</nav>
