<div class="card">
    <div class="card-header customCardHeader"><strong>{{ __('Double authentification') }}</strong></div>
    <div class="card-body">
        <p>{{ __("La double authentification (2FA) renforce la sécurité d'accès en faisant appel à deux méthodes (qu'on appelle aussi facteurs) pour vérifier votre identité. La double authentification protège du phishing, de l'ingénierie sociale et des attaques par force brute contre les mots de passe, et sécurise votre connexion contre des attaquants exploitant des identifiants faibles ou volés.") }}
        </p>

        @if ($data['user']->loginSecurity == null)
            <form class="form-horizontal" method="POST" action="{{ route('generate2faSecret') }}">
                @csrf
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary">
                        {{ __('Générer la clé secrète pour activer la 2FA') }}
                    </button>
                </div>
            </form>
        @elseif(!$data['user']->loginSecurity->google2fa_enable)
            {{ __("1. Scannez ce QR code avec l'application Google Authenticator. Vous pouvez également y entrer ce code :") }}
            <code>{{ $data['secret'] }}</code><br />
            @env('local')
            <div>{!! $data['google2fa_url'] !!}</div>
            @endenv
            @env('production')
            <img src="{{ $data['google2fa_url'] }}" alt="QR code">
            @endenv
            <br />
            {{ __("2: Entrez le code donné par l'application") }} :<br />
            <form class="form-horizontal" method="POST" action="{{ route('enable2fa') }}">
                @csrf
                <div class="form-group{{ $errors->has('verify-code') ? ' has-error' : '' }} my-4">
                    <label for="secret" class="control-label">{{ __("Code d'authentification") }}</label>
                    <input id="secret" type="password" class="form-control col-md-4" name="secret" required>
                    @if ($errors->has('verify-code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('verify-code') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-secondary">
                    {{ __('Activer la 2FA') }}
                </button>
            </form>
        @elseif($data['user']->loginSecurity->google2fa_enable)
            <p>{{ __("Si vous voulez désactiver la double authentification, veuillez confirmer votre mot de passe et cliquer sur le bouton 'Désactiver la double authentification'") }}
            </p>
            <form class="form-horizontal" method="POST" action="{{ route('disable2fa') }}">
                @csrf
                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }} my-4">
                    <label for="change-password" class="control-label">{{ __('Current Password') }}</label>
                    <input id="current-password" type="password" class="form-control col-md-4" name="current-password"
                        required>
                    @if ($errors->has('current-password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('current-password') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-outline-danger">{{ __('Désactiver la 2FA') }}</button>
            </form>
        @endif
    </div>
</div>
