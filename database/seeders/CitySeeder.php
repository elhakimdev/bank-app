<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Database\Seeders\Locations\CsvToArray;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
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
        $file = __DIR__ . '/locations/csv/cities.csv';
        $header = ['code', 'province_code', 'name', 'lat', 'long'];
        $data = $csv->csv_to_array($file, $header);
        $data = array_map(function ($arr) use ($now) {
            $arr['meta'] = json_encode(['lat' => $arr['lat'], 'long' => $arr['long']]);
            unset($arr['lat'], $arr['long']);
            return $arr + ['created_at' => $now, 'updated_at' => $now];
        }, $data);

        $collection = collect($data);
        foreach ($collection->chunk(50) as $chunk) {
            DB::table('cities')->insert($chunk->toArray());
        }
    }
}
