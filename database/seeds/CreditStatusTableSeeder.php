<?php
use Illuminate\Database\Seeder;
class CreditStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 3;
        $status = array(
            'good',
            'bad',
            'pending',
        );
        for ($i = 0; $i < $limit; $i++) {
            DB::table('credit_status')->insert([
                'name' => $status[$i]
            ]);
        }
    }
}
