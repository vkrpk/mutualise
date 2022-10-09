
<?php

//use App\Services\Pydio\User as Pydio;
include './UserSeafile.php';



function CreateUserSeafile($username,$password,$name,$quota)
{
    //$id = '{"login_id":"'.$login_id.'"}';
    $values = '{"name":"'.$name.'","email": "'.$username.'","password": "'.$password.'","quota_total":"'.$quota.'"}';
    $token = GetAuthToken();
    $result = User::CreateUser($values,$token);
    var_dump($result);
    return $result;
}


function GetAuthToken()
{
    $values = '{"username":"support@dedikam.com' . '","password":"x644RLwWdjK3'.'"}';
    $result = json_decode(User::GetToken($values),true);
    $token = $result["token"];
    return $token;
}

function GetUserSeafile($username)
{
    $token = GetAuthToken();
    $result = User::GetUser($username,$token);
    return $result;
}
