<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\PropertyValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'AMD Ryzen 5 5600', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 10499, 'description' => 'Процессор AMD Ryzen 5 5600 OEM поможет повысить производительность игрового ПК. Для этого его архитектура, основанная на 7-нм техпроцессе, представлена 6 ядрами, которые выполняют операции в 12-поточном режиме. Рабочая частота составляет 3.5 ГГц и может быть автоматически увеличена до 4.4 ГГц, что предупреждает торможение процессов загрузки. Наличие свободного множителя позволит еще увеличить частоту, чтобы улучшить игровые параметры. Поддержка виртуализации оптимизирует использование мощностей чипа. К процессору AMD Ryzen 5 5600 OEM можно подключить 2 модуля оперативной памяти, работающих с частотой 3200 МГц и имеющих объем 128 ГБ. В совокупности с кэш-памятью L3 на 32 МБ это поможет быстро выполнять действия в многозадачном режиме, с комфортом работать в сложных программах, загружать игровые локации без искажения. Низкое энергопотребление предусматривает тепловыделение на уровне 65 Вт. Благодаря этому процессор не перегревается даже при нагрузке.', 'category_id' => 7, 'sub_category_id' => 31],
            ['name' => 'AMD Ryzen 7 7800X3D', 'image' => public_path('img/seeds/r7_7800x3d.jpg'), 'price' => 28899, 'description' => '8-ядерный процессор AMD Ryzen 7 7800X3D OEM – оснащение для игровых компьютеров и производительных универсальных ПК для дома или офиса. Модель базируется на архитектуре AMD Zen 4 и произведена по техпроцессу TSMC 5nm FinFET. Базовая частота процессора – 4.2 ГГц. CPU поддерживает до 16 потоков. В турборежиме частота процессора может повышаться до 5 ГГц. Любые операции ускоряют 8-мегабайтный кэш L2 и 96-мегабайтный кэш L3. Встроенный контроллер PCI Express соответствует версии 5.0 и поддерживает 24 линии.
Особенность процессора AMD Ryzen 7 7800X3D OEM – наличие интегрированного графического ядра. GPU AMD Radeon Graphics работает на частотах до 2200 МГц. Производительность встроенной графики сопоставима с быстродействием видеокарт среднего класса.
Процессор совместим с памятью DDR5, с общим объем которой ограничен до 128 ГБ. Максимальная частота ОЗУ – 5200 МГц. Возможно использование модулей с коррекцией ошибок.
Процессор поддерживает аппаратную виртуализацию. Это расширяет функциональность ПК при работе с виртуальными машинами. OEM-комплектация модели означает отсутствие кулера.', 'category_id' => 7, 'sub_category_id' => 31],
            ['name' => 'Intel Core i5-12400F', 'image' => public_path('img/seeds/i5.jpg'), 'price' => 13299, 'description' => 'Процессор Intel Core i5-12400F OEM – отличный выбор для пользователей, желающих собрать игровой ПК или производительный универсальный компьютер. CPU имеет 6 производительных ядер. Базовая частота процессора – 2.5 ГГц. Максимальная частота в турборежиме значительно выше – 4.4 ГГц. Значительное влияние на производительность процессора оказывают 7.5-мегабайтный кэш L2 и 18-мегабайтный кэш L3. Устройство совместимо с оперативной памятью DDR4 и DDR5. Максимально поддерживаемый объем ОЗУ равен 128 ГБ.
Процессор Intel Core i5-12400F OEM отличается низким тепловыделением. TDP устройства – 65 Вт. Выбор системы охлаждения производится с учетом этого показателя. В комплекте кулер отсутствует. Максимальная рабочая температура процессора – 100 °C.', 'category_id' => 7, 'sub_category_id' => 31],
            ['name' => 'AMD Ryzen 7 5700X', 'image' => public_path('img/seeds/...'), 'price' => 14999, 'description' => '...', 'category_id' => 7, 'sub_category_id' => 31],

        ];

//        $products = [
//            ['name' => 'AMD Ryzen 5 5600', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 10499, 'description' => 'Процессор AMD Ryzen 5 5600 OEM...', 'category_id' => 7, 'sub_category_id' => 31],
//            ['name' => 'AMD Ryzen 7 7800X3D', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 28899, 'description' => '8-ядерный процессор AMD Ryzen 7 7800X3D OEM...', 'category_id' => 7, 'sub_category_id' => 31],
//            ['name' => 'Intel Core i5-12400F', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 13299, 'description' => 'Процессор Intel Core i5-12400F OEM...', 'category_id' => 7, 'sub_category_id' => 31],
//            ['name' => 'AMD Ryzen 7 5700X', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 14999, 'description' => '...', 'category_id' => 7, 'sub_category_id' => 31],
//
//            ['name' => 'Холодильник Side-by-Side', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 85000, 'description' => '...', 'category_id' => 1, 'sub_category_id' => 1],
//            ['name' => 'Холодильник No Frost', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 45000, 'description' => '...', 'category_id' => 1, 'sub_category_id' => 1],
//            ['name' => 'Стиральная машина 7кг', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 32000, 'description' => '...', 'category_id' => 1, 'sub_category_id' => 2],
//            ['name' => 'Посудомойка Bosch', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 42000, 'description' => '...', 'category_id' => 1, 'sub_category_id' => 3],
//            ['name' => 'Кофемашина DeLonghi', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 55000, 'description' => '...', 'category_id' => 1, 'sub_category_id' => 4],
//            ['name' => 'Электрическая плита', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 28000, 'description' => '...', 'category_id' => 1, 'sub_category_id' => 5],
//
//            ['name' => 'Фен Dyson', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 45000, 'description' => '...', 'category_id' => 2, 'sub_category_id' => 6],
//            ['name' => 'Выпрямитель Pro', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 5000, 'description' => '...', 'category_id' => 2, 'sub_category_id' => 7],
//            ['name' => 'Триммер Philips', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 4000, 'description' => '...', 'category_id' => 2, 'sub_category_id' => 8],
//            ['name' => 'Машинка для стрижки', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 3500, 'description' => '...', 'category_id' => 2, 'sub_category_id' => 9],
//            ['name' => 'Зубная щетка Oral-B', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 7000, 'description' => '...', 'category_id' => 2, 'sub_category_id' => 10],
//
//            ['name' => 'iPhone 15 Pro', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 120000, 'description' => '...', 'category_id' => 3, 'sub_category_id' => 11],
//            ['name' => 'iPad Air M2', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 65000, 'description' => '...', 'category_id' => 3, 'sub_category_id' => 12],
//            ['name' => 'Apple Watch 9', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 40000, 'description' => '...', 'category_id' => 3, 'sub_category_id' => 13],
//            ['name' => 'Samsung Galaxy S24', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 90000, 'description' => '...', 'category_id' => 3, 'sub_category_id' => 11],
//            ['name' => 'Чехол Leather Case', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 2000, 'description' => '...', 'category_id' => 3, 'sub_category_id' => 15],
//
//            ['name' => 'MacBook Air M3', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 110000, 'description' => '...', 'category_id' => 6, 'sub_category_id' => 26],
//            ['name' => 'Игровой ПК HyperPC', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 150000, 'description' => '...', 'category_id' => 6, 'sub_category_id' => 27],
//            ['name' => 'Моноблоки iMac 24', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 140000, 'description' => '...', 'category_id' => 6, 'sub_category_id' => 28],
//
//            ['name' => 'ASUS ROG Strix B550', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 15000, 'description' => '...', 'category_id' => 7, 'sub_category_id' => 32],
//            ['name' => 'RTX 4070 Ti', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 85000, 'description' => '...', 'category_id' => 7, 'sub_category_id' => 33],
//            ['name' => 'Kingston FURY 16GB', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 6000, 'description' => '...', 'category_id' => 7, 'sub_category_id' => 34],
//            ['name' => 'be quiet! Pure Base 500', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 9000, 'description' => '...', 'category_id' => 7, 'sub_category_id' => 35],
//            ['name' => 'DeepCool AK620', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 5500, 'description' => '...', 'category_id' => 7, 'sub_category_id' => 37],
//            ['name' => 'Samsung 980 Pro 1TB', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 12000, 'description' => '...', 'category_id' => 7, 'sub_category_id' => 38],
//
//            ['name' => 'Монитор 4K LG', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 35000, 'description' => '...', 'category_id' => 8, 'sub_category_id' => 40],
//            ['name' => 'Механическая клавиатура', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 8000, 'description' => '...', 'category_id' => 8, 'sub_category_id' => 41],
//            ['name' => 'Мышь Logitech G502', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 6500, 'description' => '...', 'category_id' => 8, 'sub_category_id' => 42],
//
//            ['name' => 'TP-Link Archer AX53', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 6000, 'description' => '...', 'category_id' => 10, 'sub_category_id' => 49],
//            ['name' => 'Bluetooth 5.0 Adapter', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 1500, 'description' => '...', 'category_id' => 10, 'sub_category_id' => 50],
//        ];

        foreach ($products as $product) {
            $item = Product::create(['name' => $product['name'], 'price' => $product['price'], 'description' => $product['description'], 'category_id' => $product['category_id'], 'sub_category_id' => $product['sub_category_id']]);

            if (File::exists($product['image'])) {
                $item->addMedia($product['image'])
                    ->preservingOriginal()
                    ->toMediaCollection('products');
            }
        }

        $propertyValues = [
            ['property_id' => 1, 'product_id' => 1, 'value' => 'DDR4'],
            ['property_id' => 4, 'product_id' => 1, 'value' => '65 Вт'],
            ['property_id' => 3, 'product_id' => 1, 'value' => 'AMD Ryzen 5 5600'],
            ['property_id' => 6, 'product_id' => 1, 'value' => '3 МБ'],
            ['property_id' => 4, 'product_id' => 1, 'value' => '32 МБ'],

            ['property_id' => 1, 'product_id' => 2, 'value' => 'DDR5'],
            ['property_id' => 4, 'product_id' => 2, 'value' => '120 Вт'],
            ['property_id' => 3, 'product_id' => 2, 'value' => 'AMD Ryzen 7 7800X3D'],
            ['property_id' => 6, 'product_id' => 2, 'value' => '8 МБ'],
            ['property_id' => 4, 'product_id' => 2, 'value' => '96 МБ'],

            ['property_id' => 1, 'product_id' => 3, 'value' => 'DDR4, DDR5'],
            ['property_id' => 4, 'product_id' => 3, 'value' => '117 Вт'],
            ['property_id' => 3, 'product_id' => 3, 'value' => 'Intel i5-12400F'],
            ['property_id' => 6, 'product_id' => 3, 'value' => '7.5 МБ'],
            ['property_id' => 4, 'product_id' => 3, 'value' => '18 МБ'],

        ];

        foreach ($propertyValues as $propertyValue) {
            PropertyValue::create(['property_id' => $propertyValue['property_id'], 'product_id' => $propertyValue['product_id'], 'value' => $propertyValue['value']]);
        }

    }
}
