<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subCategories = [
            ['name' => 'Холодильники', 'image' => public_path('img/seeds/sub_category/fridges.png'), 'category_id' => 1],
            ['name' => 'Стиральные машины', 'image' => public_path('img/seeds/sub_category/washing_machines.jpg'), 'category_id' => 1],

            ['name' => 'Смартфоны', 'image' => public_path('img/seeds/sub_category/smartphones.jpg'), 'category_id' => 2],
            ['name' => 'Планшеты', 'image' => public_path('img/seeds/sub_category/tablets.jpg'), 'category_id' => 2],

            ['name' => 'Ноутбуки', 'image' => public_path('img/seeds/sub_category/laptops.png'), 'category_id' => 3],
            ['name' => 'Персональные компьютеры', 'image' => public_path('img/seeds/category/pc_laptops.jpg'), 'category_id' => 3],

            ['name' => 'Процессоры', 'image' => public_path('img/seeds/sub_category/processors.jpg'), 'category_id' => 4],
            ['name' => 'Материнские платы', 'image' => public_path('img/seeds/sub_category/motherboard.jpg'), 'category_id' => 4],
            ['name' => 'Видеокарты', 'image' => public_path('img/seeds/sub_category/videocards.jpg'), 'category_id' => 4],
            ['name' => 'Оперативная память', 'image' => public_path('img/seeds/sub_category/ram.jpg'), 'category_id' => 4],
            ['name' => 'Блоки питания', 'image' => public_path('img/seeds/sub_category/power_supply.jpg'), 'category_id' => 4],
            ['name' => 'SSD', 'image' => public_path('img/seeds/sub_category/ssd.jpg'), 'category_id' => 4],
            ['name' => 'Жесткие диски', 'image' => public_path('img/seeds/sub_category/hdd.jpg'), 'category_id' => 4],

            ['name' => 'Мониторы', 'image' => public_path('img/seeds/sub_category/screen.jpg'), 'category_id' => 5],
            ['name' => 'Клавиатуры', 'image' => public_path('img/seeds/sub_category/keyboard.jpg'), 'category_id' => 5],
            ['name' => 'Компьютерные мыши', 'image' => public_path('img/seeds/sub_category/mouse.jpg'), 'category_id' => 5],
            ['name' => 'Наушники', 'image' => public_path('img/seeds//sub_category/headphones.jpg'), 'category_id' => 5],

        ];

        foreach ($subCategories as $item) {
            $subCategory = SubCategory::create(['name' => $item['name'], 'category_id' => $item['category_id']]);

            if (File::exists($item['image'])) {
                $subCategory->addMedia($item['image'])
                    ->preservingOriginal()
                    ->toMediaCollection('subCategory_images');
            }
        }
    }
}
