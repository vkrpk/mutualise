@extends('layouts.app')

@section('css')
    <x-profil-style />
@endsection

@section('content')
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <x-navbar :route="$data['route']"/>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-lg-8">
                <!-- Change password card-->
                <div class="card mb-4">
                    <div class="card-header">Changer votre mot de passe</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('changePassword') }}">
                            @csrf
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <!-- Form Group (current password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="oldPasswordInput">Mot de passe actuel</label>
                                <input class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput" type="password"
                                    placeholder="Mot de passe actuel" name="old_password">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Form Group (new password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="newPasswordInput">Nouveau mot de passe</label>
                                <input class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput" type="password"
                                    placeholder="Nouveau mot de passe" name="new_password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Form Group (confirm password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="confirmNewPasswordInput">Confirmer le mot de passe</label>
                                <input class="form-control" id="confirmNewPasswordInput" type="password"
                                    placeholder="Confirmer le mot de passe" name="new_password_confirmation">
                            </div>
                            <button class="btn btn-primary" type="submit">Sauvegarder</button>
                        </form>
                    </div>
                </div>
                <!-- Security preferences card-->
                <div class="card mb-4">
                    <div class="card-header">Security Preferences</div>
                    <div class="card-body">
                        <!-- Data sharing options-->
                        <h5 class="mb-1">Data Sharing</h5>
                        <p class="small text-muted">Sharing usage data can help us to improve our products and better serve
                            our users as they navigation through our application. When you agree to share usage data with
                            us, crash reports and usage analytics will be automatically sent to our development team for
                            investigation.</p>
                        <form>
                            <div class="form-check">
                                <input class="form-check-input" id="radioUsage1" type="radio" name="radioUsage"
                                    checked="">
                                <label class="form-check-label" for="radioUsage1">Yes, share data and crash reports with app
                                    developers</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="radioUsage2" type="radio" name="radioUsage">
                                <label class="form-check-label" for="radioUsage2">No, limit my data sharing with app
                                    developers</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <x-two-f-a-settings :data="$data"/>
                <div class="card mb-4">
                    <div class="card-header">Supprimer mon compte</div>
                    <div class="card-body">
                        <p>Supprimer votre compte est une action permanenete et irréversible. Si vous êtes sur de vouloir supprimer votre compte, sélectionnez le bouton ci-dessous.</p>
                        <form action="{{ route('removeUserAccount', ['id' => $data['user']->id] )}}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?');">
                            @csrf
                            <button class="btn btn-danger-soft text-danger" type="submit">Je comprends, supprimer mon compte</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
