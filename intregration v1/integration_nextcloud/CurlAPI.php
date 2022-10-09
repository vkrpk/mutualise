<?php

//namespace App\Services;

class CurlAPI
{
    private $ch;


    function __construct($url, $headers, $userpwd)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERPWD, $userpwd);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $this->ch = $ch;
    }
    function CallAPIGet()
    {

        $ch = $this->ch;
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }
    function CallAPIPost($vars)
    {
        $ch = $this->ch;
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);  //Post Fields

        $server_output = curl_exec($ch);

        curl_close($ch);
        return $server_output;
    }
}
