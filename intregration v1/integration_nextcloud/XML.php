<?php

//namespace App\Services;
require_once('User.php');

class  XML
{

    public static function ToArray($xml)
    {
        $xml = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $arr = json_decode($json, TRUE);
        return $arr; 
    }
}
