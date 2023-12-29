<?php

namespace Database\Seeders;

use App\Models\Addresses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adresses = [
            [
                "identifier" => "Victor K",
                "address" => "Default",
                "postal_code" => "75000",
                "city" => "Paris",
                "user_id" => 1
            ]
        ];
        foreach ($adresses as $adresse) {
            Addresses::create($adresse);
        }
    }
}
