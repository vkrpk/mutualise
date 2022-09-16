@extends('layouts.app')
@section('content')
    <div class="container my-4">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <x-card-2fa :data="$data"/>
            </div>
        </div>
    </div>
@endsection
