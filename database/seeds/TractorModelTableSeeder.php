<?php
use Illuminate\Database\Seeder;
class TractorModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 4;
        $model = array(
            'john deere',
            'massey ferguson',
            'mahindra',
            'new holland',
        );
        for ($i = 0; $i < $limit; $i++) {
            DB::table('tractor_model')->insert([
                'name' => $model[$i]
            ]);
        }
    }
}
