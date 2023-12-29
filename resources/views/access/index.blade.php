@extends('layouts.app')
@section('content')
<div class="container-sm overflow-hidden p-0">
    <div class="row mx-2 mx-sm-0 g-2 text-center m-3">
        <div class="alert alert-tertiary fs-3 fw-bolder" role="alert">
            <span>{{__("Mes accès")}}</span>
        </div>
    </div>
    <div class="row mx-2 mx-sm-0 g-2 m-3">
        <a href="{{ route('offers') }}" class="mt-0"><button class="btn btn-secondary btn-lg"><i class="fa-solid fa-cloud-arrow-up me-2"></i>{{__("Ajouter un accès")}}</button></a>
    </div>
    @foreach (App\Models\MemberAccess::accessesOfOneUser($userId) as $memberAccessWithSameOrderId)
        @foreach ($memberAccessWithSameOrderId as $memberAccess)
            <div class="row">
                <div class="col">
                    <div class="card mb-4">
                        <div class="card-header customCardHeader">
                            <span>{{ $memberAccess->getAccessName() }}</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <p class="mb-0">Application: {{ $memberAccess->member_access }}</p>
                                    <p class="mb-0">Email: {{ $memberAccess->getUser()->email }}</p>
                                    <p class="mb-0">{{__("Formule")}}: {{ __($memberAccess->getFormula()->name) }}</p>
                                    <p class="mb-0">{{__("Espace disque")}}: {{ $memberAccess->diskspace }} Go</p>
                                    <p class="mb-0">{{__("Type d'abonnement")}}: {{ $memberAccess->getAbonnement() }}</p>
                                    @if ($memberAccess->domain !== '')
                                        <p class="mb-0">{{__("Domaine")}}: {{ $memberAccess->domain }}</p>
                                    @endif
                                    @php
                                        if($memberAccess->member_access === 'Nextcloud') {
                                            $applicationDomain = 'https://nextcloud.victork.fr/index.php/login?clear=1';
                                        } elseif ($memberAccess->member_access === 'Seafile') {
                                            $applicationDomain = 'https://seafile.victork.fr';
                                        }
                                    @endphp
                                </div>
                                <div class="col-2 d-flex flex-column align-items-center">
                                    @foreach (json_decode($memberAccess->getFormula()->options)  as $option)
                                        <span>{{$option}}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ $memberAccess->domain !== '' ? 'https://' . $memberAccess->domain : $applicationDomain }}"><button class="btn btn-secondary">{{__("Accéder")}}</button></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>

@endsection


