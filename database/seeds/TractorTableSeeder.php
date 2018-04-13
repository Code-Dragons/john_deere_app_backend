<?php

use Illuminate\Database\Seeder;

class TractorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $pictures = [
            "https://www.deere.com/assets/images/region-4/products/tractors/utility-tractors/5r-series-utility-tractors/5r/5r_series_r4g013501_large_2d4220d5014ce5492100ca9e92440731dc5cac9b.jpg",
            "https://www.deere.com/assets/images/region-4/products/tractors/row-crop-tractors/row-crop-group/6family-rowcrop-r4b009242-1366.jpg",
            "https://www.deere.com/assets/images/region-4/products/tractors/specialty-tractors/specialty-category-hero-r4f008426.jpg",
            "https://www.deere.com/assets/images/region-4/products/tractors/utility-tractors/3-family-compact-utility-tractor/3046r-compact-utility-tractor/3046r_cut_studio_r4d040441_large_d6cc45c3c4251dd4008f33318bdd98f96627118a.jpg",
        ];
        $horsepower = ["28", "30", "42","34"];
        $model = [];
        $years = [1988,1995,2018,2017];
        for ($i = 0; $i < 4; $i++) {
            DB::table('tractor')->insert([
                'name' => "John Deere",
                'model' => 1,
                'model_number' => $faker->randomNumber($nbDigits = NULL, $strict = false),
                'description' => $faker->text(),
                'year_of_manufacture' => $faker->randomElement($years),
                'hours' => $faker->numberBetween($min = 1000, $max = 9000),
                'condition' => $faker->randomElement([1,2]),
                'horsepower' => $faker->randomElement($horsepower),
                'category' => $faker->randomElement([1,2,3,4,5,6,7,8,]),
                'drive' => $faker->randomElement([1,2,3,4]),
                'picture' => $pictures[$i],
            ]);
        }
    }
}
