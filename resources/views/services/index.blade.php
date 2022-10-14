@extends('layouts.app')
@section('content')

    <div class="container-sm overflow-hidden p-0 ">
        <div class="row mx-2 mx-sm-0 g-2 text-center m-3 d-flex flex-column align-items-center">
            <div class="alert alert-primary @isAdmin() alert-secondary @endisAdmin fs-3 fw-bolder mb-3" role="alert">
                @isAdmin() <span class="text-uppercase"> {{__("Modifier l'état des services")}}</span>@endisAdmin
                @isNotAdmin<span class="text-uppercase"> {{__("État des services")}}</span>@endisNotAdmin
            </div>
            <div class="row rounded-2 px-0 overflow-hidden border" id="serviceTable">
                @foreach (\App\Models\Service::orderBy('id', 'ASC')->get() as $service)
                    <section class="col-4 col-sm d-flex flex-column p-0 border-end">
                        <span class="bg-light py-2">{{ $service->name }}</span>
                        <div class="py-2 d-flex flex-column align-items-center bg-white">
                            <input type="hidden" name="service[{{$service->name}}]" value="0" form="changeServiceStatusForm">
                            <input type="checkbox" name="service[{{$service->name}}]" id="{{ $service->name }}" class="checkbox"
                                {{ $service->is_active ? 'checked' : '' }}
                                @isNotAdmin() disabled @endisNotAdmin
                                form="changeServiceStatusForm" value="1">
                            <label for="{{ $service->name }}" class="label"></label>
                        </div>
                    </section>
                @endforeach
            </div>
        </div>
        <a href="{{ route('make.payment') }}" class="btn btn-primary mt-3">Paypal</a>
        @isAdmin()
            <form action="{{route('serviceUpdate')}}" method="post" id="changeServiceStatusForm" class="d-flex justify-content-center py-2">
                @csrf
                <a target="_blank"><button target="_blank" class="btn btn-primary" type="submit">{{__("Valider les changements")}}</button></a>
            </form>
        @endisAdmin
    </div>

@endsection
