<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/data/cities.json');

        if (!file_exists($jsonPath)) {
            throw new \RuntimeException('Файл cities.json не найден');
        }

        $cities = json_decode(file_get_contents($jsonPath), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Ошибка в формате JSON файла cities.json');
        }

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
