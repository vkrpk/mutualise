<?php

/* namespace App\Services\NextCloud;
use App\Services\CurlAPI;
use App\Services\XML; */
require_once('CurlAPI.php');
require_once('XML.php');

class  User
{

    private static $baseURL = '';
    private static $headers = [
        'OCS-APIRequest:true',
        'Content-Type: application/x-www-form-urlencoded'
    ];
    private static $userpwd = '';

    public static function IsUserExist($username)
    {
        self::InitVariableFromEnv();
        $url = self::$baseURL . 'users/' . $username;
        $api = new CurlAPI($url, self::$headers, self::$userpwd);
        $xml = $api->CallAPIGet();
        //return $xml;

        $arr = XML::ToArray($xml);
        $isExist = $arr['meta']['status'] == 'ok' ? true : false;

        return $isExist;
/*         return (object)[
            'isExist' => $isExist,
            'status' => $arr['meta']['status'],
            'message' => $arr['meta']['message']
        ]; */
    }

    public static function CreateUser($username, $password, $email,$quota)
    {

        self::InitVariableFromEnv();
        $values = [
            'userid' => $username,
            'password' => $password,
            'email' => $email,
            'quota' => $quota,

        ];
        $params = http_build_query($values);

        $url = self::$baseURL . 'users';
        $api = new CurlAPI($url, self::$headers, self::$userpwd);
        $xml = $api->CallAPIPost($params);  
        var_dump($xml); 
        $arr = XML::ToArray($xml);
        $isCreated = $arr['meta']['status'] == 'ok' ? true : false;
        return $isCreated;
        
        /* return (object)[
            'isCreated' => $isCreated,
            'status' => $arr['meta']['status'],
            'message' => $arr['meta']['message']
        ]; */
    }


    private static function InitVariableFromEnv()
    {
        /* self::$baseURL = env('NEXTCLOUD_BASEURL_API');
        self::$userpwd = env('NEXTCLOUD_USERPWD'); */
        self::$baseURL =$_ENV['NEXTCLOUD_BASEURL_API'];
        self::$userpwd =$_ENV['NEXTCLOUD_USERPWD'];
    }
}
