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
            ['name' => 'Посудомоечные машины', 'image' => public_path('img/seeds/sub_category/dishwashers.jpg'), 'category_id' => 1],
            ['name' => 'Кофемашины', 'image' => public_path('img/seeds/sub_category/coffe_machines.jpg'), 'category_id' => 1],
            ['name' => 'Плиты', 'image' => public_path('img/seeds/sub_category/pliti.jpg'), 'category_id' => 1],

            ['name' => 'Фены', 'image' => public_path('img/seeds/sub_category/hair_dryers.jpg'), 'category_id' => 2],
            ['name' => 'Выпрямители волос', 'image' => public_path('img/seeds/sub_category/rectifiers.jpg'), 'category_id' => 2],
            ['name' => 'Триммеры', 'image' => public_path('img/seeds/sub_category/trimmers.jpg'), 'category_id' => 2],
            ['name' => 'Машинки для стрижки волос', 'image' => public_path('img/seeds/sub_category/hair_clippers.jpg'), 'category_id' => 2],
            ['name' => 'Электрические зубные щетки', 'image' => public_path('img/seeds/sub_category/toothbrash.jpg'), 'category_id' => 2],

            ['name' => 'Смартфоны', 'image' => public_path('img/seeds/sub_category/smartphones.jpg'), 'category_id' => 3],
            ['name' => 'Планшеты', 'image' => public_path('img/seeds/sub_category/tablets.jpg'), 'category_id' => 3],
            ['name' => 'Смарт-часы', 'image' => public_path('img/seeds/sub_category/smart_watches.jpg'), 'category_id' => 3],
            ['name' => 'Сотовые телефоны', 'image' => public_path('img/seeds/sub_category/cell_phones.jpg'), 'category_id' => 3],
            ['name' => 'Другие аксессуры', 'image' => public_path('img/seeds/sub_category/accesses.png'), 'category_id' => 3],

            ['name' => 'Фотоаппараты', 'image' => public_path('img/seeds/sub_category/cameras.jpg'), 'category_id' => 4],
            ['name' => 'Экшн-камеры', 'image' => public_path('img/seeds/sub_category/action_cameras.jpg'), 'category_id' => 4],
            ['name' => 'Объективы', 'image' => public_path('img/seeds/sub_category/lenses.jpg'), 'category_id' => 4],
            ['name' => 'Штативы и стабилизаторы', 'image' => public_path('img/seeds/sub_category/stabilizers.jpg'), 'category_id' => 4],
            ['name' => 'Питание для фотоаппаратов', 'image' => public_path('img/seeds/sub_category/power_for_cameras.jpg'), 'category_id' => 4],

            ['name' => 'Телевизоры', 'image' => public_path('img/seeds/sub_category/tv.jpg'), 'category_id' => 5],
            ['name' => 'Кронштейны для телевизоров', 'image' => public_path('img/seeds/sub_category/brackets.jpg'), 'category_id' => 5],
            ['name' => 'Консоли', 'image' => public_path('img/seeds/sub_category/console.jpg'), 'category_id' => 5],
            ['name' => 'Портативные консоли', 'image' => public_path('img/seeds/sub_category/pe_console.jpg'), 'category_id' => 5],
            ['name' => 'Контроллеры и геймпады', 'image' => public_path('img/seeds/sub_category/controllers.png'), 'category_id' => 5],

            ['name' => 'Ноутбуки', 'image' => public_path('img/seeds/sub_category/laptops.png'), 'category_id' => 6],
            ['name' => 'Персональные компьютеры', 'image' => public_path('img/seeds/category/pc_laptops.jpg'), 'category_id' => 6],
            ['name' => 'Моноблоки', 'image' => public_path('img/seeds/sub_category/monoblocks.jpg'), 'category_id' => 6],
            ['name' => 'Мини-компьютеры', 'image' => public_path('img/seeds/sub_category/mini_pc.webp'), 'category_id' => 6],
            ['name' => 'Программное обеспечение', 'image' => public_path('img/seeds/sub_category/software.png'), 'category_id' => 6],

            ['name' => 'Процессоры', 'image' => public_path('img/seeds/sub_category/processors.jpg'), 'category_id' => 7],
            ['name' => 'Материнские платы', 'image' => public_path('img/seeds/sub_category/motherboard.jpg'), 'category_id' => 7],
            ['name' => 'Видеокарты', 'image' => public_path('img/seeds/sub_category/videocards.jpg'), 'category_id' => 7],
            ['name' => 'Оперативная память', 'image' => public_path('img/seeds/sub_category/ram.jpg'), 'category_id' => 7],
            ['name' => 'Корпуса', 'image' => public_path('img/seeds/sub_category/case.jpg'), 'category_id' => 7],
            ['name' => 'Блоки питания', 'image' => public_path('img/seeds/sub_category/power_supply.jpg'), 'category_id' => 7],
            ['name' => 'Охлаждение компьютера', 'image' => public_path('img/seeds/sub_category/cooler.jpg'), 'category_id' => 7],
            ['name' => 'SSD', 'image' => public_path('img/seeds/sub_category/ssd.jpg'), 'category_id' => 7],
            ['name' => 'Жесткие диски', 'image' => public_path('img/seeds/sub_category/hdd.jpg'), 'category_id' => 7],

            ['name' => 'Мониторы', 'image' => public_path('img/seeds/sub_category/screen.jpg'), 'category_id' => 8],
            ['name' => 'Клавиатуры', 'image' => public_path('img/seeds/sub_category/keyboard.jpg'), 'category_id' => 8],
            ['name' => 'Компьютерные мыши', 'image' => public_path('img/seeds/sub_category/mouse.jpg'), 'category_id' => 8],
            ['name' => 'Веб-камеры', 'image' => public_path('img/seeds/sub_category/web_cam.jpg'), 'category_id' => 8],
            ['name' => 'Крепеления для мониторов', 'image' => public_path('img/seeds/sub_category/monitor_mounts.jpg'), 'category_id' => 8],

            ['name' => 'Наушники', 'image' => public_path('img/seeds//sub_category/headphones.jpg'), 'category_id' => 9],
            ['name' => 'Колонки', 'image' => public_path('img/seeds/sub_category/speaker.jpg'), 'category_id' => 9],
            ['name' => 'Микрофоны', 'image' => public_path('img/seeds/sub_category/microphone.png'), 'category_id' => 9],
            ['name' => 'Звуковые карты', 'image' => public_path('img/seeds/sub_category/sound_card.png'), 'category_id' => 9],

            ['name' => 'Wi-Fi роутеры', 'image' => public_path('img/seeds/sub_category/wi-fi_routers.jpg'), 'category_id' => 10],
            ['name' => 'Адаптеры Bluetooth', 'image' => public_path('img/seeds/sub_category/adapter.jpg'), 'category_id' => 10],
            ['name' => 'Сетевые карты', 'image' => public_path('img/seeds/sub_category/network_card.jpg'), 'category_id' => 10],
            ['name' => 'Камеры', 'image' => public_path('img/seeds/sub_category/ip-cameras.png'), 'category_id' => 10],
            ['name' => 'Коммутаторы', 'image' => public_path('img/seeds/sub_category/commutators.jpg'), 'category_id' => 10],

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
