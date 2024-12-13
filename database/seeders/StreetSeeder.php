<?php

namespace Database\Seeders;

use App\Models\Street;
use Illuminate\Database\Seeder;

class StreetSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('seeders/data/streets.json');

        if (!file_exists($jsonPath)) {
            throw new \RuntimeException('Файл streets.json не найден');
        }

        $streets = json_decode(file_get_contents($jsonPath), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Ошибка в формате JSON файла streets.json');
        }

        foreach ($streets as $street) {
            Street::create($street);
        }
    }
}
