<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'name' => "NextCloud",
                'is_active' => true,
            ],
            [
                'name' => "Pydio",
                'is_active' => true,
            ],
            [
                'name' => "SSH",
                'is_active' => true,
            ],
            [
                'name' => "RSync",
                'is_active' => true,
            ],
            [
                'name' => "SFTP",
                'is_active' => true,
            ],
            [
                'name' => "FTPS/FTP",
                'is_active' => true,
            ],
            [
                'name' => "CIFS",
                'is_active' => true,
            ],
            [
                'name' => "WEBDAV",
                'is_active' => true,
            ],
            [
                'name' => "iSCSI",
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
