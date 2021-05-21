<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Database\Seeders\Locations\CsvToArray;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class VillageSeeder extends Seeder
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
        $resourceFiles =  File::allFiles(__DIR__ . '/locations/csv/villages');
        foreach ($resourceFiles as $file) {
            $header = ['code', 'district_code', 'name', 'lat', 'long'];
            $data = $csv->csv_to_array($file->getRealPath(), $header);
            $data = array_map(function ($arr) use ($now) {
                $arr['meta'] = json_encode(['lat' => $arr['lat'], 'long' => $arr['long']]);
                unset($arr['lat'], $arr['long']);
                return $arr + ['created_at' => $now, 'updated_at' => $now];
            }, $data);
            $collection = collect($data);
            foreach ($collection->chunk(50) as $chunk) {
                DB::table('villages')->insert($chunk->toArray());
            }
        }
    }
}
