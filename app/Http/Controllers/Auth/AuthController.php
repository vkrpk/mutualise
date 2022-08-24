<?php

use Cache;
use Illuminate\Http\Request;
use IlluminateSupportFacadesAuth;
use Illuminate\Support\Facades\Auth;
use AppHttpRequestsValidateSecretRequest;
use Illuminate\Contracts\Auth\Authenticatable;

class Controller {
    private function authenticated(Request $request, Authenticatable $user) {

                if ($user->google2fa_secret){
                    Auth::logout();

                    $request->session()->put('2fa:user:id', $user->id);

                    return redirect('2fa/validate');
                }
                return redirect()->intended($this->redirectTo);
    }



        public function getValidateToken() {

                if (session('2fa:user:id')){
                    return view('2fa/validate');

                }

                return redirect('login');
        }

        public function postValidateToken(ValidateSecretRequest $request){
            $userId = $request->session()->pull('2fa:user:id');
            $key[]   = $userId . ':';
        }

}
