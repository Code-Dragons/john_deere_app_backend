<?php

use Illuminate\Database\Seeder;

class ContributionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $amount = [23454, 24000, 25000, 22435, 26789 ];
        $id = [1,2,3,4,5];
        $phone_numbers = ["0722123456", "0722123457", "0722123458", "0722123459", "0722123455"];
        for ($i = 0; $i < 5; $i++) {
            DB::table('contribution')->insert([
                'amount' => $amount[$i],
                'user_id' => $id[$i],
                'group_id' => 1
            ]);
        }
    }
}
