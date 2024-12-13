<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;
class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/data/regions.json');

        if (!file_exists($jsonPath)) {
            throw new \RuntimeException('Файл regions.json не найден');
        }

        $regions = json_decode(file_get_contents($jsonPath), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Ошибка в формате JSON файла regions.json');
        }

        foreach ($regions as $region) {
            Region::create($region);
        }
    }
}
