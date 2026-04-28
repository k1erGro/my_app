<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [
            ['name' => 'Тип памяти'],
            ['name' => 'Тип'],
            ['name' => 'Модель'],
            ['name' => 'TDP'],
            ['name' => 'Год релиза'],
            ['name' => 'Объем кэша L2'],
            ['name' => 'Объем кэша L3'],
            ['name' => 'Процессор'],
            ['name' => 'Разрешение экрана'],
            ['name' => 'ОЗУ'],
        ];
        foreach ($properties as $property) {
            Property::create(['name' => $property['name']]);
        }
    }
}
