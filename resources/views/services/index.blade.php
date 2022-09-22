@extends('layouts.app')
@section('content')

    <div class="container-sm overflow-hidden p-0">
        <div class="row mx-2 mx-sm-0 g-2 text-center m-3 d-flex flex-column align-items-center">
            <div class="alert alert-primary fs-3 fw-bolder mb-3" role="alert">
                <span class="text-uppercase">état des services</span>
            </div>
            <div class="row rounded-2 px-0 overflow-hidden border" id="serviceTable">
                @foreach (\App\Models\Service::all() as $service)
                    <section class="col-4 col-sm d-flex flex-column p-0 border-end">
                        <span class="bg-light py-2">{{ $service->name }}</span>
                        <div class="py-2 d-flex flex-column align-items-center bg-white">
                            <input type="checkbox" name="{{ $service->name }}" id="{{ $service->name }}" class="checkbox"
                                {{ $service->is_active ? 'checked' : '' }}
                                @isNotAdmin() disabled @endisNotAdmin
                                form="changeServiceStatusForm">
                            <label for="{{ $service->name }}" class="label"></label>
                        </div>
                    </section>
                @endforeach
            </div>
        </div>
    </div>
    @isAdmin()
        <p>Admin</p>
        <form action="#" method="post" id="changeServiceStatusForm">
            <button class="btn btn-primary" type="submit">Envoyer</button>
        </form>
    @endisAdmin
@endsection
