@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">Two Factor Authentication</div>
                    <div class="card-body">
                        <p>Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.</p>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <p>Enter the pin from Google Authenticator app:</p>
                        <form class="form-horizontal" action="{{ route('2faVerify') }}" method="POST">
                            @csrf
                            <div class="form-group{{ $errors->has('one_time_password-code') ? ' has-error' : '' }} mb-2">
                                <label for="one_time_password" class="control-label">One Time Password</label>
                                <input id="one_time_password" name="one_time_password" class="form-control col-md-4"  type="text" required/>
                            </div>
                            <button class="btn btn-secondary" type="submit">Authenticate</button>
                            <a href="{{ request()->headers->get('referer') }}"><button type="button" class="btn btn-secondary">Revenir en arrière</button></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
