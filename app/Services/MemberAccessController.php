<?php
namespace App\Services;

class MemberAccessController {
    private $ch;

    function __construct($url, $headers, $userpwd) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERPWD, $userpwd);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $this->ch = $ch;
    }

    function callAPIGet() {
        $server_output = curl_exec($this->ch);
        curl_close($this->ch);
        return $server_output;
    }

    function callAPIPost(string $queryString) {
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $queryString);
        $server_output = curl_exec($this->ch);
        curl_close($this->ch);
        return $server_output;
    }
}
