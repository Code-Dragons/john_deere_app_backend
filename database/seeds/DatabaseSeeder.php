<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('GroupTableSeeder');
        $this->call('CreditStatusTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('TractorCategoryTableSeeder');
        $this->call('TractorConditionTableSeeder');
        $this->call('TractorModelTableSeeder');
        $this->call('DriveTableSeeder');
        $this->call('TractorTableSeeder');
        $this->call('ContributionTableSeeder');
    }
}
