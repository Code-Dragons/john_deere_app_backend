<?php
use Illuminate\Database\Seeder;
class TractorCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 8;
        $tractor = array(
            'utility tractor',
            'row crop tractor',
            'orchard tractor',
            'industrial tractor',
            'garden tractor',
            'rotary tractor',
            'implement carrier',
            'earth moving tractor'
        );
        for ($i = 0; $i < $limit; $i++) {
            DB::table('tractor_category')->insert([
                'name' => $tractor[$i]
            ]);
        }
    }
}
