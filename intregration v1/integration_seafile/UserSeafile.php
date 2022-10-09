<?php

//namespace App\Services\Pydio;

//use App\Services\CurlAPI;
//use App\Services\XML;
// include 'CurlAPI.php';

class User
{


    private static $baseURL = '';
    private static $headers = [
        'Content-Type: application/json',
        'Connection: keep-alive',
    ];


    public static function GetToken($values)
    {

        // self::InitVariableFromEnv();

        $url = "https://seafile.dedikam.com/" . 'api2/auth-token/';

        $response = self::PostCurl($url,self::$headers,$values);

        /* $api = new CurlAPI($url,self::$headers);
        return $api->CallAPIPost($values);
 */
        return $response;

    }


    public static function CreateUser($values,$token)
    {

        // self::InitVariableFromEnv();
        $url = "https://seafile.dedikam.com/"."api/v2.1/admin/users/";
        array_push(self::$headers,"Authorization: Token ".$token);
        $response = self::PostCurl($url,self::$headers,$values);
        $response = json_decode($response,true);
        return isset($response['email']);

    }


    public static function UpdateUser($username,$values,$token)
    {

        // self::InitVariableFromEnv();
        $url = "https://seafile.dedikam.com/"."api/v2.1/admin/users/".$username."/";
        array_push(self::$headers,"Authorization: Token ".$token);
        $response = self::PutCurl($url,self::$headers,$values);
        $response = json_decode($response,true);
        print_r($url);
        print_r($values);
        var_dump($response);
        return isset($response['email']);

    }


    public static function GetUser($username,$token)
    {

        // self::InitVariableFromEnv();
        $url = "https://seafile.dedikam.com/"."api/v2.1/admin/users/".$username."/";

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

    private static function InitCurl($url,$headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return $ch;
    }

    private static function PostCurl($url,$headers,$values)
    {
        $ch = self::InitCurl($url,$headers);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $values);
        $server_output = curl_exec($ch);
        curl_close($ch);

        return $server_output;
    }

    private static function GetCurl($url,$headers)
    {
        $ch = self::InitCurl($url,$headers);

        $server_output = curl_exec($ch);
        curl_close($ch);

        return $server_output;
    }

    private static function PutCurl($url,$headers,$values)
    {

        $ch = self::InitCurl($url,$headers);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $values);
        $server_output = curl_exec($ch);

          if (curl_errno($ch)) {
            echo curl_error($ch);
        }

        //$info = curl_getinfo($ch);

        curl_close($ch);

        return $server_output;
    }

    // private static function InitVariableFromEnv()
    // {
    //     // "https://seafile.dedikam.com/" = env('PYDIO_BASEURL_API');
    //     "https://seafile.dedikam.com/" = $_ENV['SEAFILE_BASEURL_API'];
    // }
}
