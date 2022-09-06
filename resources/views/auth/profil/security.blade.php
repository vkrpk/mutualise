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
                                <label class="form-check-label" for="radioUsage2">No, limit my data sharing with app
                                <input class="form-check-input" id="radioUsage2" type="radio" name="radioUsage">
                                    developers</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <x-two-f-a-settings :data="$data"/>
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
                                            <label class="small mb-1 @error('password') is-invalid @enderror" for="passwordConfirmation">Mot de passe actuel</label>
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
                                    <button form="changeEmailForm" type="submit" class="btn btn-primary" id="submitButtonEmailChangeForm">Envoyez</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
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

@push('scripts')
@parent
<script type="text/javascript" defer>
    window.onload = function() {
        let href = "{{ route('user.email-change') }}";
        let form = document.getElementById("changeEmailForm")
        let button = document.getElementById("submitButtonEmailChangeForm")
        var myModal = new bootstrap.Modal("#staticBackdrop");
        const inputErrorPasswordConfirmation = document.getElementById("passwordConfirmation")
        const inputErrorEmail = document.getElementById("emailChange")

        form.addEventListener("submit", function (event) {
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
            fetch(href, request)
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
                        myModal.hide()
                    } else {
                        const addErrorMessage = function(array, input) {
                            array.forEach(error => {
                                let spanError = document.createElement('span')
                                spanError.innerHTML = `${error}`
                                spanError.classList.add('text-danger')
                                input.insertAdjacentElement('afterend', spanError)
                            });
                        }

                        cleanErrorMessages()

                        // if(response.passwordCheckNotValid === true) {
                        //     let spanError = document.createElement('span')
                        //     spanError.innerHTML = 'Le mot de passe ne correspond pas'
                        //     spanError.classList.add('text-danger')
                        //     inputErrorPasswordConfirmation.insertAdjacentElement('afterend', spanError)
                        // }

                        if(response.email){
                            addErrorMessage(response.email, inputErrorEmail)
                        }
                        if(response.password){
                            addErrorMessage(response.password, inputErrorPasswordConfirmation)
                        }
                        if(response.passwordCheckNotValid){
                            addErrorMessage(response.passwordCheckNotValid, inputErrorPasswordConfirmation)
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
        {{-- // $.ajaxSetup({
            //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });
                // $(".btn-submit").click(function(e){
                    //     e.preventDefault();
                    //     var title = $("#titleID").val();
                    //     var body = $("#bodyID").val();
    //     $.ajax({
        //        type:'POST',
        //        url:"",
        //        data:{title:title, body:body},
        //        success:function(data){
            //             if($.isEmptyObject(data.error)){
    //                 alert(data.success);
    //                 location.reload();
    //             }else{
    //                 printErrorMsg(data.error);
    //             }
    //        }
    //     });
    // });
    // function printErrorMsg (msg) {
        //     $(".print-error-msg").find("ul").html('');
        //     $(".print-error-msg").css('display','block');
        //     $.each( msg, function( key, value ) {
            //         $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            //     });
            // } --}}


