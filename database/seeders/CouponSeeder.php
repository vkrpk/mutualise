<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coupons = [
            [
                "code" => "12345",
                "value" => 10.5,
                "is_active" => true
            ],
            [
                "code" => "54321",
                "value" => 10.5,
                "is_active" => false
            ]
        ];
        foreach ($coupons as $coupon) {
            Coupon::create($coupon);
        }
    }
}
