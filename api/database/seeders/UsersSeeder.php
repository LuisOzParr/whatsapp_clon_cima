<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                "name" => config('app.user.name'),
                "phone_number" => config('app.user.phone_number'),
                "password" => bcrypt(config('app.user.password')),
            ]
        ]);

        User::factory(10)
            ->state(new Sequence(
                ['phone_number' => '1000000000'],
                ['phone_number' => '2000000000'],
                ['phone_number' => '3000000000'],
                ['phone_number' => '4000000000'],
                ['phone_number' => '5000000000'],
                ['phone_number' => '6000000000'],
                ['phone_number' => '7000000000'],
                ['phone_number' => '8000000000'],
                ['phone_number' => '9000000000'],
                ['phone_number' => '1000000000'],
            ))
            ->create();
    }
}
