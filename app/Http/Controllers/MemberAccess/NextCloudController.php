<?php

namespace App\Http\Controllers\MemberAccess;

use App\Models\MemberAccess;
use App\Services\CurlController;

class NextCloudController
{
    private $headers;

    public function __construct() {
        $this->headers = [
            'OCS-APIRequest:true',
            'Content-Type: application/x-www-form-urlencoded'
        ];
    }

    public function create(MemberAccess $memberAccess, string $dedikamAccessName) {
        $datas = [
            'userid' => $memberAccess->email,
            'password' => 'passwordpassword',
            'email' => $memberAccess->email,
            'quota' => 0
        ];
        $url = env('NEXTCLOUD_BASEURL_API') . 'users';
        $ch = (new CurlController($url, $this->headers));
        $ch->getChForNextcloud(env('NEXTCLOUD_USERPWD'));
        $xml = $ch->callAPIPost(http_build_query($datas));
        $arr = self::xmlToArray($xml);
        return $arr['meta']['status'] === 'ok' ? true : false;
    }

    public function getUser(string $email) {
        $url = env('NEXTCLOUD_BASEURL_API') . 'users/' . $email;
        $ch = (new CurlController($url, $this->headers));
        $ch->getChForNextcloud(env('NEXTCLOUD_USERPWD'));
        $xml = $ch->callAPIGet();
        $arr = self::xmlToArray($xml);
        return $arr['data'] == [] ? false : $arr['data'];
    }

    public function listUsers() {
        $url = env('NEXTCLOUD_BASEURL_API') . 'users';
        $ch = (new CurlController($url, $this->headers));
        $ch->getChForNextcloud(env('NEXTCLOUD_USERPWD'));
        $xml = $ch->callAPIGet();
        $arr = self::xmlToArray($xml);
        return $arr['data']['users']['element'] == [] ? false : $arr['data']['users']['element'];
    }

    public static function xmlToArray($xml) {
        $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $arr = json_decode($json, TRUE);
        return $arr;
    }

    public function deleteUser(string $email) {
        $url = env('NEXTCLOUD_BASEURL_API') . 'users/' . $email;
        $curl = (new CurlController($url, $this->headers));
        $ch = $curl->getChForNextcloud(env('NEXTCLOUD_USERPWD'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        return $curl->callAPIGet();
    }

    public function deleteAllUsers() {
        $allUsers = $this->listUsers();
        foreach ($allUsers as $user) {
            if($user !==  'nextcloud@victork.fr'){
                $this->deleteUser($user);
            }
        }
    }
}
