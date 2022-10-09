Copier le contenu dans le dossier Services dans App de laravel



NEXTCLOUD

Ajouter le lien et password dans .env
exemple:
NEXTCLOUD_BASEURL_API=www.nextcloud.me/ocs/v1.php/cloud/
NEXTCLOUD_USERPWD=admin:password

Creation d'utilisateur:
use App\Services\NextCloud\User as NextCloudUser;
$result = NextCloudUser::CreateUser('jerry4', '123sdfj lsdkfjlmqsdkjfg4', 'jerry@jerry.be');


SEAFILE

Ajouter dans config un fichie seafile.php

1er partie info sur le serveur et les api
2em info par defaut pour la creation du user
3em user & mot de passe

return [

    'url_base'      =>  'http://172.18.0.2/',
    'token_uri'     =>  'api2/auth-token/',
    'ping_uri'      =>  'api2/auth/ping/',
    'users_uri'     =>  'api/v2.1/admin/users/',
    
    'is_staff'      =>  false,
    'is_active'     =>  true,
    'role'          =>  null,
    'name'          =>  null,
    'login_id'      =>  null,
    'contact_email' =>  null,
    'reference_id'  =>  null,
    'departement'   =>  null,
    'quota_total'   =>  '1000',

    'admin_email'   =>  'me@example.com',
    'admin_password'=>  'asecret'

];


Creation de user:

use App\Services\Seafile\User as SeafileUser;

        $values= [
            'email'         =>  'momo7.bauduin@gmail.com',
            'password'      =>  'password1234',
            'is_staff'      =>  config('seafile.is_staff'),
            'is_active'     =>  config('seafile.is_active'),
            'role'          =>  config('seafile.role'),
            'name'          =>  config('seafile.name'),
            'login_id'      =>  config('seafile.login_id'),
            'contact_email' =>  config('seafile.contact_email'),
            'reference_id'  =>  config('seafile.reference_id'),
            'departement'   =>  config('seafile.departement'),
            'quota_total'   =>  config('seafile.quota_total'),
        ];
        $result = SeafileUser::CreateUser($values);