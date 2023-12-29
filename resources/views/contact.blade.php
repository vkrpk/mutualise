@php
    $address = \App\Models\Addresses::where("user_id", Auth::id())->first();
@endphp

@extends('layouts.app')

@section('content')
    <div class="container-xl px-4 my-4">
        <div class="card">
            <div class="card-header customCardHeader"><strong>{{__("Formulaire de contact")}}</strong></div>
            <div class="card-body">
                <form method="post" action="{{ route('contact.send') }}" id="contactForm">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-floating mt-2">
                                <input type="text" class="form-control" id="object" name="object" placeholder="object" value="{{ old('object') }}">
                                <label for="object">{{__("Objet")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
                                @error('object')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 ">
                            <div class="form-floating mt-2">
                                <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{{ old('email') ?? Auth::user()->email ?? '' }}">
                                <label for="email">{{__("Email")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-floating mt-2">
                                <input type="text" class="form-control" id="identifier" name="identifier" placeholder="identifier" value="{{ old('identifier') ?? $address->identifier ?? '' }}">
                                <label for="identifier">{{__("Nom complet ou nom de l'entreprise")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
                                @error('identifier')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 ">
                            <div class="form-floating mt-2">
                                <input type="tel" class="form-control" id="tel" name="tel" placeholder="tel" value="{{ old('tel') ?? $address->phone_number ?? '' }}">
                                <label for="tel">{{__("Téléphone")}}</label>
                                @error('tel')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mt-2">
                        <textarea class="form-control" id="content" style="height: 10rem;" name="content" placeholder="content">{{ old('content') }}</textarea>
                        <label class="form-label" for="content">{{__("Message")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <input class="form-check-input me-2" type="checkbox" id="privacy_policy" form="contactForm" name="privacy_policy">
                <label class="form-check-label d-inline" for="privacy_policy"> {{__("En soumettant ce formulaire, j'accepte que les informations saisies soient utilisées selon les finalités décrites dans la ")}}<a class="text-primary" href="{{ route('footer.politique-confidentialite') }}">{{lcfirst(__("Politique de confidentialité"))}}</a>.</label><br>
                @error('privacy_policy')
                    <span class="ms-3 text-danger">{{__("Vous devez accepter la politique de confidentialité pour continuer.")}}</span>
                @enderror
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="btn btn-secondary btn-lg" form="contactForm"><i class="fa-solid fa-envelope me-2"></i>{{__("Envoyer")}}</button>
        </div>
    </div>
@endsection
