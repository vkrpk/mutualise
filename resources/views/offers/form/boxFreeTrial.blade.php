@guest
    <h4 class="card-title align-self-center">{{__("Offre d'essai : 10 Go gratuits en vous")}} <a class="text-decoration-underline text-secondary" href="{{ route('login') }}"> {{__("connectant")}}</a>.</h4>
    <p class="card-text align-self-center">{{__("Testez les fonctionnalités Mutualisé gratuitement pendant 30 jours.")}}
        <br>{{__("Vous pouvez commander jusqu'à 4 accès gratuits.")}}</p>
@endguest

@auth
    <h4 class="card-title align-self-center">{{__("Offre d'essai : 10 Go gratuits")}}</h4>
    <p class="card-text align-self-center">{{__("Testez les fonctionnalités Mutualisé gratuitement pendant 30 jours.")}}
    <br>{{__("Vous pouvez commander jusqu'à 4 accès gratuits. Un accès gratuit correspond à la formule standard.")}}
    <br>{{__("Il vous reste actuellement :nbfreeaccount disponible(s) sur votre compte.", ['nbfreeaccount' => $nbfreeaccount])}}</p>
    <div class="form-check align-self-center">
        <input name="isFreeTrial" id="isFreeTrial" class="form-check-input" type="checkbox" {{ $nbfreeaccount==0 ? 'disabled' : '' }} form="formAddToCart" autocomplete="off">
        @error('isFreeTrial')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <label class="form-check-label" for="isFreeTrial">{{__("Profiter de l'offre")}}</label>
    </div>
@endauth
