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
            <div class="col-md-6">
                <!-- Change password card-->
                <div class="card mb-4">
                    <div class="card-header">{{__("Update Password")}}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('changePassword') }}">
                            @csrf
                            <!-- Form Group (current password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="oldPasswordInput">{{__("Current Password")}}</label>
                                <input class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput" type="password"
                                    placeholder="{{__("Current Password")}}" name="old_password">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Form Group (new password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="newPasswordInput">{{__("New Password")}}</label>
                                <input class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput" type="password"
                                    placeholder="{{__("New Password")}}" name="new_password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Form Group (confirm password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="confirmNewPasswordInput">{{__("Confirm Password")}}</label>
                                <input class="form-control" id="confirmNewPasswordInput" type="password"
                                    placeholder="{{__("Confirm Password")}}" name="new_password_confirmation">
                            </div>
                            <button class="btn btn-primary" type="submit">{{__("Save")}}</button>
                        </form>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">Changer mon adresse email</div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="buttonForOpenModal">
                            Changer mon adresse email
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Changer d'adresse email</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Veuillez renseigner votre mot de passe.</p>
                                        <p>Pour effectuer le changement, veuillez cliquer sur le lien présent dans le mail envoyé à la nouvelle adresse.</p>
                                        <form id="changeEmailForm">
                                            <div class="mb-3">
                                                @csrf
                                                <label class="small mb-1 for="passwordConfirmation">Mot de passe actuel</label>
                                                <input class="form-control" type="password" name="password" id="passwordConfirmation">
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="emailChange">Ma nouvelle adresse email</label>
                                                <input class="form-control" type="text" name="email" id="emailChange">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermez</button>
                                        <button form="changeEmailForm" type="submit" class="btn btn-primary">Envoyez</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <label class="form-check-label" for="radioUsage2">No, limit my data sharing with app
                                <input class="form-check-input" id="radioUsage2" type="radio" name="radioUsage">
                                    developers</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row justify-content-md-center mb-4">
                    <div class="col">
                        <x-card-2fa :data="$data"/>                        
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">Supprimer mon compte</div>
                    <div class="card-body">
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteAccount" id="buttonForOpenModal">
                            Supprimer mon compte
                        </button>
                        <div class="modal fade" id="modalDeleteAccount" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteAccountLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalDeleteAccountLabel">Supprimer mon compte</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Supprimer votre compte est une action permanenete et irréversible. Si vous êtes sur de vouloir supprimer votre compte, sélectionnez le bouton ci-dessous.</p>
                                        <form id="formDeleteAccount">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="small mb-1" for="passwordConfirmationDeleteAccount">Mot de passe actuel</label>
                                                <input class="form-control" type="password" name="password" id="passwordConfirmationDeleteAccount">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermez</button>
                                        <button form="formDeleteAccount" class="btn btn-primary" type="submit">Je comprends, supprimer mon compte</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@parent
<script type="text/javascript" defer>
window.onload = function() {
    let formEmailChange = document.getElementById("changeEmailForm")
    let formDeleteAccount = document.getElementById("formDeleteAccount")
    var modalChangeEmail = new bootstrap.Modal("#staticBackdrop");
    var modalDeleteAccount = new bootstrap.Modal("#modalDeleteAccount");
    const inputErrorPasswordConfirmation = document.getElementById("passwordConfirmation")
    const inputErrorEmail = document.getElementById("emailChange")
    const inputErrorPasswordConfirmationDeleteAccount= document.getElementById("passwordConfirmationDeleteAccount")
    const addErrorMessage = function(array, input) {
        array.forEach(error => {
            let spanError = document.createElement('span')
            spanError.innerHTML = `${error}`
            spanError.classList.add('text-danger')
            input.insertAdjacentElement('afterend', spanError)
        });
    }


    formEmailChange.addEventListener("submit", function (event) {
        event.preventDefault()
        let request =  {
            method: 'POST',
            body: JSON.stringify({
                password: document.getElementById("passwordConfirmation").value,
                email: document.getElementById("emailChange").value
            }),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': "application/json"
            }
        }
        fetch("{{ route('user.email-change') }}", request)
            .then((response) => response.json())
            .then((response) => {
                const cleanErrorMessages = function() {
                    if(inputErrorPasswordConfirmation.nextElementSibling != null) {
                        inputErrorPasswordConfirmation.nextElementSibling.remove()
                    }
                    if(inputErrorEmail.nextElementSibling != null) {
                        inputErrorEmail.nextElementSibling.remove()
                    }
                }
                if (response.passwordAndEmail === true) {
                    cleanErrorMessages()
                    modalChangeEmail.hide()
                } else {
                    cleanErrorMessages()

                    if(response.email){
                        addErrorMessage(response.email, inputErrorEmail)
                    }
                    if(response.password){
                        addErrorMessage(response.password, inputErrorPasswordConfirmation)
                    }
                }
            })
            .catch((error) => {
                alert(error)
            })
    })

    formDeleteAccount.addEventListener("submit", function (event) {
        event.preventDefault()
        let request =  {
            method: 'POST',
            body: JSON.stringify({
                password: document.getElementById("passwordConfirmationDeleteAccount").value,
            }),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': "application/json"
            }
        }
        fetch("{{ route('removeUserAccount') }}", request)
            .then((response) => response.json())
            .then((response) => {
                const cleanErrorMessages = function() {
                    if(inputErrorPasswordConfirmationDeleteAccount.nextElementSibling != null) {
                        inputErrorPasswordConfirmationDeleteAccount.nextElementSibling.remove()
                    }
                }
                if (response.password === true) {
                    cleanErrorMessages()
                    modalDeleteAccount.hide()
                    window.location.replace("{{ route('home') }}")
                } else {
                    cleanErrorMessages()

                    if(response.password){
                        addErrorMessage(response.password, inputErrorPasswordConfirmationDeleteAccount)
                    }
                }
            })
            .catch((error) => {
                alert(error)
            })
    })
}
</script>
@endpush


