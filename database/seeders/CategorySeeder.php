<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Бытовая техника', 'image' => public_path('img/seeds/...')],
            ['name' => 'Красота и здоровье', 'image' => public_path('img/seeds/...')],
            ['name' => 'Смартфоны и планшеты', 'image' => public_path('img/seeds/...')],
            ['name' => 'Фототехника', 'image' => public_path('img/seeds/...')],
            ['name' => 'ТВ и консоли', 'image' => public_path('img/seeds/...')],
            ['name' => 'ПК и ноутбуки', 'image' => public_path('img/seeds/...')],
            ['name' => 'Комплектующие для пк', 'image' => public_path('img/seeds/...')],
            ['name' => 'Периферия', 'image' => public_path('img/seeds/...')],
            ['name' => 'Аудиотехника', 'image' => public_path('img/seeds/...')],
            ['name' => 'Сетевое оборудование', 'image' => public_path('img/seeds/...')],
        ];

        foreach ($categories as $item) {
            $category = Category::create(['name' => $item['name']]);

            if (File::exists($item['image'])) {
                $category->addMedia($item['image'])
                    ->preservingOriginal()
                    ->toMediaCollection('category_images');
            }
        }
    }
}
