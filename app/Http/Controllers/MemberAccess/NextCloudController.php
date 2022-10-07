<?php

namespace App\Http\Controllers\MemberAccess;

use App\Models\MemberAccess;
use App\Services\MemberAccessController;

class NextCloudController
{
    private $headers;

    public function __construct() {
        $this->headers = [
            'OCS-APIRequest:true',
            'Content-Type: application/x-www-form-urlencoded'
        ];
    }

    public function create(MemberAccess $memberAccess, string $passwordNotHash, string $dedikamAccessName) {
        $datas = [
            // 'userid' => $memberAccess->name,
            'userid' => $dedikamAccessName,
            'password' => $passwordNotHash,
            'email' => $memberAccess->getUser()->email,
            'quota' => 1073741824 * $memberAccess->diskspace,
        ];
        $url = env('NEXTCLOUD_BASEURL_API') . 'users';
        $api = new MemberAccessController($url, $this->headers, env('NEXTCLOUD_USERPWD'));
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
