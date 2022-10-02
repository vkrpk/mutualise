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
        Addresses::create([
            "identifier" => "Michael Bihary",
            "address" => "Default",
            "postal_code" => "75000",
            "city" => "Paris",
            "user_id" => 1
        ]);
    }
}
