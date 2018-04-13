<?php
use Illuminate\Database\Seeder;
class TractorConditionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 2;
        $condition = array(
            'brand new',
            'used',
        );
        for ($i = 0; $i < $limit; $i++) {
            DB::table('tractor_condition')->insert([
                'name' => $condition[$i]
            ]);
        }
    }
}
