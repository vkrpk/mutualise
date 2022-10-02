@extends('layouts.app')

@section('css')
    <x-profil-style />
@endsection

@section('content')
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <x-navbar :route="$route" />
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">{{__('Profile Picture')}}</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle mb-2"
                            src="{{ Auth::user()->avatar !== '' ? asset('avatars_uploads/' . Auth::user()->avatar) : Vite::asset('resources/images/users/avatars/default.png') }}" alt="avatar">
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
                <div class="card mb-4">
                    <div class="card-header">{{__("Détails du compte")}}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('storeInfos') }}">
                            @csrf
                            <x-adresses-card :address="$address" :form="''"/>
                            <button class="btn btn-primary" type="submit">{{__("Save")}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
