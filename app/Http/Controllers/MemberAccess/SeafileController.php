<?php

namespace App\Http\Controllers\MemberAccess;

use App\Models\MemberAccess;
use App\Services\MemberAccessController;

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
        $jsonDatas = // $id = '{"login_id":"' . $login_id . '"}';
            '{"name":"' . $dedikamAccessName .
            '","email": "' . $memberAccess->getUser()->email .
            '","password": "' . $passwordNotHash .
            '","quota_total":"' . $memberAccess->diskspace * 8000 .
            '"}';
        $authToken = self::getAuthToken();
        $url = env('SEAFILE_BASEURL_API') . "api/v2.1/admin/users/";
        array_push(self::$headers, "Authorization: Token " . $authToken);
        // $server_output = json_decode(self::getServerOutput($url, self::$headers, $jsonDatas), true);
        $api = (new MemberAccessController($url, self::$headers, env('SEAFILE_PWD')))->callAPIPost($url);
        $server_output = json_decode($api, true);
        return isset($server_output['email']);
    }

    private static function initCurl(string $url, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return $ch;
    }

    public static function getAuthToken()
    {
        $jsonDatas = '{"username":"' . env('SEAFILE_EMAIL') . '","password":"' . env('SEAFILE_PWD') . '"}';
        $url = env('SEAFILE_BASEURL_API') . 'api2/auth-token/';
        $server_output = self::getServerOutput($url, self::$headers, $jsonDatas);
        $authToken = json_decode($server_output, true); // $api = new CurlAPI($url,self::$headers); return $api->CallAPIPost($jsonDatas);
        return $authToken["token"];
    }

    private static function getServerOutput(string $url, array $headers, string $jsonDatas)
    {
        $ch = self::initCurl($url, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDatas);
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }

    function GetUserSeafile($username)
    {
        $token = GetAuthToken();
        return self::GetUser($username,$token);
    }

    public static function GetUser($username,$token)
    {
        $url = env('SEAFILE_BASEURL_API') . "api/v2.1/admin/users/" . $username. "/";
        array_push(self::$headers,"Authorization: Token ".$token);
        //$api = new CurlAPI($url,self::$headers);
        //$response = json_decode($api->CallAPIGet(),true);
        $response = json_decode(self::GetCurl($url,self::$headers),true);
        if(isset($response['email']))
        {
            return $response;
        }

        return;

    }

    private static function GetCurl($url,$headers)
    {
        $ch = self::initCurl($url,$headers);
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }



    public function create2(MemberAccess $memberAccess, string $passwordNotHash, string $dedikamAccessName) {
        $datas = [
            // 'userid' => $memberAccess->name,
            'userid' => $dedikamAccessName,
            'password' => $passwordNotHash,
            'email' => $memberAccess->getUser()->email,
            'quota' => 1073741824 * $memberAccess->diskspace,
        ];
        $url = env('NEXTCLOUD_BASEURL_API') . 'users';
        $api = new MemberAccessController($url, self::$headers, env('NEXTCLOUD_USERPWD'));
        $xml = $api->callAPIPost(http_build_query($datas));
        $arr = self::xmlToArray($xml);
        return $arr['meta']['status'] === 'ok' ? true : false;
    }

    public static function xmlToArray($xml) {
        $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $arr = json_decode($json, TRUE);
        return $arr;
    }
}
