<?php

namespace App\Http\Controllers\MemberAccess;

use App\Models\MemberAccess;
use App\Services\CurlController;

class SeafileController
{
    private static $headers;

    public function __construct() {
        self::$headers = [
            'Content-Type: application/json',
            'Connection: keep-alive'
        ];
    }

    public function create(MemberAccess $memberAccess, string $passwordNotHash, string $dedikamAccessName) {
        $jsonDatas =
            '{"name":"' . $dedikamAccessName .
            '","email": "' . $memberAccess->getUser()->email .
            '","password": "' . $passwordNotHash .
            '","quota_total":"' . $memberAccess->diskspace * 8000 .
            '"}';
        $url = env('SEAFILE_BASEURL_API') . "api/v2.1/admin/users/";
        array_push(self::$headers, "Authorization: Token " . self::getAuthToken());
        $server_output = json_decode(self::getServerOutput($url, self::$headers, $jsonDatas), true);
        return (isset($server_output['email']) ?? false);
    }

    public static function updateUser(MemberAccess $memberAccess)
    {
        $jsonDatas =
            '{"quota_total":"' . $memberAccess->diskspace * 8000 .
            '"}';
        $url = env('SEAFILE_BASEURL_API') . "api/v2.1/admin/users/" . $memberAccess->getUser()->email . "/";
        array_push(self::$headers, "Authorization: Token " . self::getAuthToken());
        $curl = new CurlController($url, self::$headers);
        $ch = $curl->getChForSeafile();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDatas);
        return json_decode($curl->callAPIGet(), true);
    }

    public static function getAuthToken() {
        $jsonDatas = '{"username":"' . env('SEAFILE_EMAIL') . '","password":"' . env('SEAFILE_PWD') . '"}';
        $url = env('SEAFILE_BASEURL_API') . 'api2/auth-token/';
        $server_output = self::getServerOutput($url, [
            'Content-Type: application/json',
            'Connection: keep-alive'
        ], $jsonDatas);
        $authToken = json_decode($server_output, true);
        return $authToken["token"];
    }

    private static function getServerOutput(string $url, array $headers, string $jsonDatas) {
        $curl = new CurlController($url, $headers);
        $ch = $curl->getChForSeafile();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        return $curl->callAPIPost($jsonDatas);
    }

    public static function getUser(string $email) {
        $url = env('SEAFILE_BASEURL_API') . "api/v2.1/admin/users/" . $email . "/";
        array_push(self::$headers, "Authorization: Token " . self::getAuthToken());
        $curl = new CurlController($url, self::$headers);
        $ch = $curl->getChForSeafile();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return json_decode($curl->callAPIGet(), true);
    }

    public static function listUsers() {
        $url = env('SEAFILE_BASEURL_API') . "api/v2.1/admin/users/";
        array_push(self::$headers, "Authorization: Token " . self::getAuthToken());
        $curl = new CurlController($url, self::$headers);
        $ch = $curl->getChForSeafile();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return json_decode($curl->callAPIGet(), true);
    }

    public static function deleteUser(string $email) {
        $url = env('SEAFILE_BASEURL_API') . 'api/v2.1/admin/users/' . $email . '/';
        array_push(self::$headers, "Authorization: Token " . self::getAuthToken());
        $curl = new CurlController($url, self::$headers);
        $ch = $curl->getChForSeafile();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }
}
