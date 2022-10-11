@extends('layouts.app')
@section('content')
    <div class="container-sm overflow-hidden p-0">
        <div class="row mx-2 mx-sm-0 g-2 text-center m-3">
            <div class="alert alert-primary fs-3 fw-bolder" role="alert">
                <span>{{__("Mes accès")}}</span>
            </div>
        </div>
        <div class="row mx-2 mx-sm-0 g-2 m-3">
            <a href="{{ route('offers') }}"><button class="btn btn-secondary btn-lg"><i class="fa-solid fa-cloud-arrow-up me-2"></i>{{__("Ajouter un accès")}}</button></a>
        </div>
    </div>

    @foreach (App\Models\MemberAccess::accessesOfOneUser($userId) as $memberAccessWithSameOrderId)
        @foreach ($memberAccessWithSameOrderId as $memberAccess)
            <div class="card">
                <h2>{{ $memberAccess->id }}</h2>
                {{ $memberAccess->getAccessName() }}
                {{ $memberAccess->getFormula()->name }}
                @foreach (json_decode($memberAccess->getFormula()->options)  as $option)
                    {{$option}}
                    <br>
                @endforeach
                {{ $memberAccess->getUser()->email }}
            </div>
        @endforeach
    @endforeach
@endsection
