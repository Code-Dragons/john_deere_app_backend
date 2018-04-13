<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $names = ["Bernard Mulobi", "Felistas Ngumi", "Jonathan Kamau", "Charles Oduk", "Sam Achola"];
        $id = ["23445566", "23445567", "23445568", "23445569", "23445565"];
        $phone_numbers = ["0722123456", "0722123457", "0722123458", "0722123459", "0722123455"];
        for ($i = 0; $i < 5; $i++) {
            DB::table('users')->insert([
                'name' => $names[$i],
                'national_id' => $id[$i],
                'phone_number' => $phone_numbers[$i],
                'password' => app('hash')->make('password'),
                'group_id' => 1,
                'credit_status_id' => 1,
                'remember_token' => str_random(10),
            ]);
        }
    }
}
