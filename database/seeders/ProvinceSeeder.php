<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\Locations\CsvToArray;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $csv = new CsvToArray();
        $file = __DIR__ . '/locations/csv/provinces.csv';
        $header = ['code', 'name', 'lat', 'long'];
        $data = $csv->csv_to_array($file, $header);
        $data = array_map(function ($arr) use ($now) {
            $arr['meta'] = json_encode(['lat' => $arr['lat'], 'long' => $arr['long']]);
            unset($arr['lat'], $arr['long']);
            return $arr + ['created_at' => $now, 'updated_at' => $now];
        }, $data);

        DB::table('provinces')->insert($data);
    }
}
