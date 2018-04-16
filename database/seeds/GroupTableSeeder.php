<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group')->insert([
            'name' => 'Lenken Group',
            'location' => 'Kiambu',
            'tractor_ids' => 1,
            'loan_amount' => 320000,
            'created_by' => 1,
        ]);
    }
}
