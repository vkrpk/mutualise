<?php

namespace App\Support;

use PragmaRX\Google2FALaravel\Support\Authenticator;

class Google2FAAuthenticator extends Authenticator
{
    protected function canPassWithoutCheckingOTP()
    {
        if ($this->getUser()) {
            if ($this->getUser()->loginSecurity == null) {
                return true;
            } else {
                return
                    !$this->getUser()->loginSecurity->google2fa_enable ||
                    !$this->isEnabled() ||
                    $this->noUserIsAuthenticated() ||
                    $this->twoFactorAuthStillValid();
            }
        } else {
            return true;
        }
    }

    protected function getGoogle2FASecretKey()
    {
        $secret = $this->getUser()->loginSecurity->{$this->config('otp_secret_column')};

        if (is_null($secret) || empty($secret)) {
            throw new InvalidSecretKey('Secret key cannot be empty.');
        }

        return $secret;
    }
}
