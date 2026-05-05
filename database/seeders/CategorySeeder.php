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
            ['name' => 'Бытовая техника', 'image' => public_path('img/seeds/category/fridges.jpg')],
            ['name' => 'Красота и здоровье', 'image' => public_path('img/seeds/category/beauty.png')],
            ['name' => 'Смартфоны и планшеты', 'image' => public_path('img/seeds/category/spartphones.jpg')],
            ['name' => 'Фототехника', 'image' => public_path('img/seeds/category/photographic_equipment.jpg')],
            ['name' => 'ТВ и консоли', 'image' => public_path('img/seeds/category/TV_console.jpg')],
            ['name' => 'ПК и ноутбуки', 'image' => public_path('img/seeds/category/pc_laptops.jpg')],
            ['name' => 'Комплектующие для пк', 'image' => public_path('img/seeds/category/accessories_for_pc.png')],
            ['name' => 'Периферия', 'image' => public_path('img/seeds/category/periphery.jpg')],
            ['name' => 'Аудиотехника', 'image' => public_path('img/seeds/category/audio_equipment.png')],
            ['name' => 'Сетевое оборудование', 'image' => public_path('img/seeds/category/network_equipment.png')],
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
