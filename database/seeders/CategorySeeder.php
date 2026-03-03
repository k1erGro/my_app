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
            ['name' => 'Компьютеры и ноутбуки', 'image' => public_path('img/seeds/computers.jpg')],
            ['name' => 'Компоненты ПК', 'image' => public_path('img/seeds/pc_components.jpg')],
            ['name' => 'Периферия', 'image' => public_path('img/seeds/periphery.jpg')],
            ['name' => 'Смартфоны', 'image' => public_path('img/seeds/smartphones.jpg')],
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
