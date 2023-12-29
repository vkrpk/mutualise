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
                'name' => 'vic',
                'email' => 'mutualise@victork.fr',
                'password' => Hash::make('Password54@'),
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
