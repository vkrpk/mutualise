<?php
namespace App\Services;

class CurlController {
    private $ch;

    function __construct(string $url, array $headers) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $this->ch = $ch;
    }

    function callAPIGet() {
        $server_output = curl_exec($this->ch);
        curl_close($this->ch);
        return $server_output;
    }

    function callAPIPost(string|array $datas) {
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $datas);
        $server_output = curl_exec($this->ch);
        curl_close($this->ch);
        return $server_output;
    }

    function getChForNextcloud(string $password) {
        curl_setopt($this->ch, CURLOPT_USERPWD, $password);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        return $this->ch;
    }

    function getChForSeafile() {
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        return $this->ch;
    }
}
