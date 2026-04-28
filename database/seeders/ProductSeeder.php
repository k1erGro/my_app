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
            ['name' => 'AMD Ryzen 5 5600', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 10499, 'description' => 'Процессор AMD Ryzen 5 5600 OEM поможет повысить производительность игрового ПК. Для этого его архитектура, основанная на 7-нм техпроцессе, представлена 6 ядрами, которые выполняют операции в 12-поточном режиме. Рабочая частота составляет 3.5 ГГц и может быть автоматически увеличена до 4.4 ГГц, что предупреждает торможение процессов загрузки. Наличие свободного множителя позволит еще увеличить частоту, чтобы улучшить игровые параметры. Поддержка виртуализации оптимизирует использование мощностей чипа. К процессору AMD Ryzen 5 5600 OEM можно подключить 2 модуля оперативной памяти, работающих с частотой 3200 МГц и имеющих объем 128 ГБ. В совокупности с кэш-памятью L3 на 32 МБ это поможет быстро выполнять действия в многозадачном режиме, с комфортом работать в сложных программах, загружать игровые локации без искажения. Низкое энергопотребление предусматривает тепловыделение на уровне 65 Вт. Благодаря этому процессор не перегревается даже при нагрузке.', 'category_id' => 1, 'sub_category_id' => 1],
            ['name' => 'AMD Ryzen 7 7800X3D', 'image' => public_path('img/seeds/r7_7800x3d.jpg'), 'price' => 28899, 'description' => '8-ядерный процессор AMD Ryzen 7 7800X3D OEM – оснащение для игровых компьютеров и производительных универсальных ПК для дома или офиса. Модель базируется на архитектуре AMD Zen 4 и произведена по техпроцессу TSMC 5nm FinFET. Базовая частота процессора – 4.2 ГГц. CPU поддерживает до 16 потоков. В турборежиме частота процессора может повышаться до 5 ГГц. Любые операции ускоряют 8-мегабайтный кэш L2 и 96-мегабайтный кэш L3. Встроенный контроллер PCI Express соответствует версии 5.0 и поддерживает 24 линии.
Особенность процессора AMD Ryzen 7 7800X3D OEM – наличие интегрированного графического ядра. GPU AMD Radeon Graphics работает на частотах до 2200 МГц. Производительность встроенной графики сопоставима с быстродействием видеокарт среднего класса.
Процессор совместим с памятью DDR5, с общим объем которой ограничен до 128 ГБ. Максимальная частота ОЗУ – 5200 МГц. Возможно использование модулей с коррекцией ошибок.
Процессор поддерживает аппаратную виртуализацию. Это расширяет функциональность ПК при работе с виртуальными машинами. OEM-комплектация модели означает отсутствие кулера.', 'category_id' => 1, 'sub_category_id' => 1],
            ['name' => 'Intel Core i5-12400F', 'image' => public_path('img/seeds/i5.jpg'), 'price' => 13299, 'description' => 'Процессор Intel Core i5-12400F OEM – отличный выбор для пользователей, желающих собрать игровой ПК или производительный универсальный компьютер. CPU имеет 6 производительных ядер. Базовая частота процессора – 2.5 ГГц. Максимальная частота в турборежиме значительно выше – 4.4 ГГц. Значительное влияние на производительность процессора оказывают 7.5-мегабайтный кэш L2 и 18-мегабайтный кэш L3. Устройство совместимо с оперативной памятью DDR4 и DDR5. Максимально поддерживаемый объем ОЗУ равен 128 ГБ.
Процессор Intel Core i5-12400F OEM отличается низким тепловыделением. TDP устройства – 65 Вт. Выбор системы охлаждения производится с учетом этого показателя. В комплекте кулер отсутствует. Максимальная рабочая температура процессора – 100 °C.', 'category_id' => 1, 'sub_category_id' => 1],
        ];

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
