@guest
    <h4 class="card-title align-self-center">Offre d'essai : 10 Go gratuits en vous <a href="{{ route('login') }}"> connectant.</a></h4>
    <p class="card-text align-self-center">Testez toutes les fonctionnalités Dedikam gratuitement pendant 30 jours.
        <br>Vous pouvez commander jusqu'à 4 accès gratuits.</p>
@endguest

@auth
    <h4 class="card-title align-self-center">Offre d'essai : 10 Go gratuits</h4>
    <p class="card-text align-self-center">Testez toutes les fonctionnalités Dedikam gratuitement pendant 30 jours.
    <br>Vous pouvez commander jusqu'à 4 accès gratuits. Un accès gratuit correspond à la formule standard.
    <br>Il vous en reste {{ $nbfreeaccount }} actuellement disponible sur votre compte.</p>
    <div class="form-check align-self-center">
        <input name="form_free_account" id="check_free_account" class="form-check-input" type="checkbox" id="formCheck-1" {{ $nbfreeaccount==0 ? 'disabled' : '' }}>
        <label class="form-check-label" for="formCheck-1">Profiter de l'offre</label>
    </div>
@endauth
