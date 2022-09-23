@extends('layouts.app')

@section('css')
    <x-profil-style />
@endsection

@section('content')
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <x-navbar :route="$route" >
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">{{__('Profile Picture')}}</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        {{-- {{ dd(Auth::user()->avatar) }} --}}
                        <img class="img-account-profile rounded-circle mb-2"
                            src="{{ Vite::asset(Auth::user()->avatar) }}" alt="avatar">
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">{{__("JPG/JPEG ou PNG inférieur à 5MB")}}</div>
                        <!-- Profile picture upload button-->
                        <form action="{{ route('profil.store-picture') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="avatar" id="avatar">
                            @error('avatar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <p><button class="btn btn-primary mt-4" type="submit">{{__("Uploader une nouvelle image")}}</button></p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                {{-- <div class="card mb-4">
                    <div class="card-header">{{__("Détails du compte")}}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('storeInfos') }}">
                            @csrf
                            <!-- Form Group (username)-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="label">{{__("Libellé de l'adresse")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
                                    <input class="form-control" id="label" type="text" value="{{ old('label') ? old('label') : $address->label ?? '' }}"
                                        placeholder="" name="label">
                                    @error('label')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="organization">{{__("Organisation")}}</label>
                                    <input class="form-control" id="organization" type="text"
                                        placeholder="" value="{{ old('organization') ? old('organization') : $address->organization ?? '' }}" name="organization">
                                </div>
                                <!-- Form Group (last name)-->

                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="first_name">{{__("Prénom")}}</label>
                                    <input class="form-control" id="first_name" type="text"
                                        placeholder="" value="{{ old('first_name') ? old('first_name') : $address->first_name ?? '' }}" name="first_name">
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="last_name">{{__("Nom")}}</label>
                                    <input class="form-control" id="last_name" type="text"
                                        placeholder="" value="{{ old('last_name') ? old('last_name') : $address->last_name ?? '' }}" name="last_name">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="address1">{{__("Adresse")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
                                    <input class="form-control" id="address1" type="text"
                                        placeholder="" value="{{ old('address1') ? old('address1') : $address->address1 ?? '' }}" name="address1">
                                    @error('address1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="address2">{{__("Complément d'adresse")}}</label>
                                    <input class="form-control" id="address2" type="text"
                                        placeholder="" value="{{ old('address2') ? old('address2') : $address->address2 ?? ''}}" name="address2">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="postal_code">{{__("Code postal")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
                                    <input class="form-control" id="postal_code" type="text"
                                        placeholder="" value="{{ old('postal_code') ? old('postal_code') : $address->postal_code ?? '' }}" name="postal_code">
                                    @error('postal_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="city">{{__("Ville")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
                                    <input class="form-control" id="city" type="text"
                                        placeholder="" value="{{ old('city') ? old('city') : $address->city ?? '' }}" name="city">
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="state">{{__("État/Province")}}</label>
                                    <input class="form-control" id="state" type="text"
                                        placeholder="" value="{{ old('state') ? old('state') : $address->state ?? '' }}" name="state">
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="country">{{__("Pays")}}</label>
                                    <input class="form-control" id="country" type="text"
                                        placeholder="" value="{{ old('country') ? old('country') : $address->country ?? '' }}" name="country">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="phone_number">{{__("Numéro de téléphone")}}</label>
                                    <input class="form-control" id="phone_number" type="text"
                                        placeholder="" value="{{ old('phone_number') ? old('phone_number') : $address->phone_number ?? '' }}" name="phone_number">
                                </div>
                                <!-- Form Group (last name)-->

                            </div>
                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="submit">{{__("Save")}}</button>
                        </form>
                    </div>
                </div> --}}
                <x-adresses-card :address="$address" />
            </div>
        </div>
    </div>
@endsection
