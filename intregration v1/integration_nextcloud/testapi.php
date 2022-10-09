
<?php 

//use App\Services\NextCloud\User as NextCloudUser;
include 'User.php';
//$result = User::IsUserExist('dedikam2');
$result = User::CreateUser('dk005560', '123sdfj lsdkfjlmqsdkjfg4', 'test@dedikam.com','10000000000');
print_r($result);

?>