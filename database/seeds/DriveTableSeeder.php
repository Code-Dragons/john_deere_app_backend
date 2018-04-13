<?php
use Illuminate\Database\Seeder;
class DriveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 4;
        $drive = array(
            'two wheel drive',
            'four wheel drive',
            'mechanical front wheel drive',
            'hydraulic front wheel drive',
        );
        for ($i = 0; $i < $limit; $i++) {
            DB::table('drive')->insert([
                'name' => $drive[$i]
            ]);
        }
    }
}
