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
            ['name' => 'ПК', 'image' => public_path('img/seeds/Ardor-Gaming-Neo.jpg'), 'category_id' => 1],
            ['name' => 'Процессоры', 'image' => public_path('img/seeds/processor.jpg'), 'category_id' => 2],
            ['name' => 'Клавиатуры', 'image' => public_path('img/seeds/keyboard.jpg'), 'category_id' => 3],
            ['name' => 'Iphone', 'image' => public_path('img/seeds/iphone.jpg'), 'category_id' => 4],
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
