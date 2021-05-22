<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdministrativeAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProvinceSeeder::class,
            CitySeeder::class,
            DistrictSeeder::class,
            VillageSeeder::class
        ]);
    }
}
