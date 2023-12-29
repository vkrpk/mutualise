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
                    <div class="card-header customCardHeader">{{__("Update Password")}}</div>
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
                            <button class="btn btn-secondary" type="submit">{{__("Save")}}</button>
                        </form>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header customCardHeader">{{__("Changer mon adresse email")}}</div>
                    <div class="card-body">
                        <p>Adresse email actuelle: {{ Auth::user()->email }}</p>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="buttonForOpenModal">
                            {{__("Changer mon adresse email")}}
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">{{__("Changer mon adresse email")}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{__("Please confirm your password before continuing.")}}</p>
                                        <p>{{__("Pour effectuer le changement, veuillez cliquer sur le lien présent dans le mail envoyé à la nouvelle adresse.")}}</p>
                                        <form id="changeEmailForm">
                                            <div class="mb-3">
                                                @csrf
                                                <label class="small mb-1" for="passwordConfirmation">{{__("Current Password")}}</label>
                                                <input class="form-control" type="password" name="password" id="passwordConfirmation">
                                            </div>
                                            <div class="mb-3">
                                                <label class="small mb-1" for="emailChange">{{__("Ma nouvelle adresse mail")}}</label>
                                                <input class="form-control" type="text" name="email" id="emailChange">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__("Close")}}</button>
                                        <button form="changeEmailForm" type="submit" class="btn btn-secondary">{{__("Send")}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <div class="card-header customCardHeader">{{__("Supprimer mon compte")}}</div>
                    <div class="card-body">
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteAccount" id="buttonForOpenModal">
                            {{__("Supprimer mon compte")}}
                        </button>
                        <div class="modal fade" id="modalDeleteAccount" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteAccountLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalDeleteAccountLabel">{{__("Delete Account")}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{__("Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.")}}</p>
                                        <form id="formDeleteAccount">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="small mb-1" for="passwordConfirmationDeleteAccount">{{__("Current Password")}}</label>
                                                <input class="form-control" type="password" name="password" id="passwordConfirmationDeleteAccount">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__("Close")}}</button>
                                        <button form="formDeleteAccount" class="btn btn-secondary" type="submit">{{__("Je comprends, supprimer mon compte")}}</button>
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


