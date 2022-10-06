<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@email.com',
                'password' => Hash::make('admin'),
                'role_id' => 1,
                'nb_free_account' => 0,
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Ikam',
                'email' => 'ikam@dedikam.com',
                'password' => Hash::make('biharry2022*'),
                'role_id' => 1,
                'nb_free_account' => 0,
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'Bob',
                'email' => 'bobrazowskitrash@gmail.com',
                'password' => Hash::make('321321321'),
                'role_id' => 2,
                'nb_free_account' => 0,
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name' => 'vic',
                'email' => 'victor.krupka@orange.fr',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'nb_free_account' => 0,
                'email_verified_at' => Carbon::now(),
            ]
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
