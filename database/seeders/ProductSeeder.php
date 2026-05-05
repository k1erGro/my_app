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

    const MODELS = [
        'LG',
        'Beko'
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Холодильник Side by Side Бирюса SBS 400 I', 'image' => public_path('img/seeds/product/fridge/side_by_side.webp'), 'price' => 39999, 'description' => 'Холодильник Side by Side Бирюса SBS 400 I серого цвета имеет объем 400 литров и подойдет для больших семей или в случае частых покупок. Система размораживания No Frost исключает необходимость ручного размораживания, так как предотвращает образование льда и инея внутри холодильника. Цифровой дисплей позволяет управлять настройками холодильника, температурой и режимами работы. Модель состоит из двух отдельных камер: морозильной и холодильной.', 'category_id' => 1, 'sub_category_id' => 1],
            ['name' => 'Холодильник с морозильником KRAFT KF-NF271W', 'image' => public_path('img/seeds/product/fridge/kraft.webp'), 'price' => 26799, 'description' => 'Белый холодильник KRAFT KF-NF271W имеет холодильную камеру на 129 л и морозильную камеру на 64 л. Они обе оснащены системой No Frost, которая предотвращает образование инея и льда. Внутри есть стеклянные и навесные полки, отсек для яиц, а также выдвижные ящики для размещения овощей и фруктов. В морозилке поддерживается температура -18 °C, которая позволяет замораживать продукты со скоростью 3 кг/сутки. Дополнительно в этой камере предусмотрена форма для льда.', 'category_id' => 1, 'sub_category_id' => 1],
            ['name' => 'Холодильник с морозильником LG GA-B509MQSL', 'image' => public_path('img/seeds/product/fridge/lg_ga.webp'), 'price' => 26799, 'description' => 'Холодильник LG GA-B509MQSL может похвастаться наличием инверторного компрессора, который обеспечивает полное отсутствие посторонних шумов во время работы устройства. С этим домашним помощником вы всегда сможете наслаждаться полезными и свежими фруктами – а все благодаря нулевой камере с постоянной циркуляцией воздушного потока. Внешний дисплей в непрерывном режиме отображает текущие температурные показатели.', 'category_id' => 1, 'sub_category_id' => 1],
            ['name' => 'Холодильник с морозильником Samsung RB37A5211B1/WT', 'image' => public_path('img/seeds/product/fridge/samsung.webp'), 'price' => 62999, 'description' => 'Холодильник с морозильником Samsung RB37A5211B1/WT серого цвета с многопоточной системой охлаждения имеет общий полезный объем 367 л. Внутри есть две камеры: холодильная на 269 литров и морозильная на 98 литра, которая располагается внизу. У модели две дверцы, и на одной из них есть три полки и отдельный отсек для яиц. Дверцы открываются слева направо, но их можно перевесить. Ручки скрытые, расположены вертикально. Нулевой зазор позволяет открывать дверь холодильника ровно на 90 градусов, обеспечивая при этом свободное выдвижение ящиков, контейнеров или полок.', 'category_id' => 1, 'sub_category_id' => 1],
            ['name' => 'Холодильник компактный NORD NT 90 B', 'image' => public_path('img/seeds/product/fridge/nord.webp'), 'price' => 14999, 'description' => 'Холодильник NORD NT 90 B — это компактная двухкамерная модель с верхним расположением морозильной камеры высотой 84,5 см. Благодаря небольшим размерам устройство станет отличным выбором для дачи, офиса, гостиничного номера или общежития. Общий объем холодильника составляет 88 литров, что делает его удобным решением при ограниченном пространстве.', 'category_id' => 1, 'sub_category_id' => 1],

            ['name' => 'Стиральная машина LG F1296NDS1', 'image' => public_path('img/seeds/product/washing_machine/lg.webp'), 'price' => 32999, 'description' => 'Стиральная машина LG F1296NDS1 станет практичным решением вопроса с чистотой белья даже в небольшой ванной. Ее ширина и глубина составляют 60 и 44 см соответственно. При этом за один раз прибор способен очистить до 6 кг белья за цикл. За счет большого количества встроенных программ получится создать оптимальные условия для стирки вещей из любой ткани. Для дополнительной чистоты можно обработать вещи паром. Если вам сейчас неудобно стирать, перенесите время начала работы прибора на удобный момент с помощью таймера на 19 ч.', 'category_id' => 1, 'sub_category_id' => 2],
            ['name' => 'Стиральная машина Indesit IWUD 4085 (CIS)', 'image' => public_path('img/seeds/product/washing_machine/indesit.webp'), 'price' => 24799, 'description' => 'Стиральная машина INDESIT IWUD 4085 оснащена электроприводом, что позволяет существенно сократить траты электроэнергии и воды, а также уменьшить шумовой эффект от работы до минимума. При небольших габаритах эта машинка позволяет погрузить до 4 кг белья. Энергосбережение было классифицировано, европейской организацией стандартов, оценкой «А», такой же оценкой отмечена эффективность стирки.', 'category_id' => 1, 'sub_category_id' => 2],
            ['name' => 'Стиральная машина Beko WSPE6H612W', 'image' => public_path('img/seeds/product/washing_machine/beko.webp'), 'price' => 24999, 'description' => 'Стиральная машина Beko WSPE6H612W с фронтальной загрузкой до 6.5 кг вещей и надежным инверторным двигателем станет надежной помощницей в бытовом хозяйстве. Экспресс-программа позволяет выполнять стирку до 2 кг вещей за 14 минут. Специально для бережной стирки спортивных вещей предусмотрена программа «Спорт/Мембрана». Технология Pet Hair Removal способствует эффективному устранению шерсти домашних питомцев с вещей. Функция Fast+ в автоматическом режиме определяет тип ткани и количество одежды. Из других особенностей отмечаются дозагрузка белья и обработка паром.', 'category_id' => 1, 'sub_category_id' => 2],
            ['name' => 'Стиральная машина Haier HW50-BP1026', 'image' => public_path('img/seeds/product/washing_machine/haier.webp'), 'price' => 39999, 'description' => 'Стиральная машина Haier HW50-BP1026 с фронтальной загрузкой на 5 кг оснащена барабаном Pillow. Отверстия в виде подушечек не провоцируют порчу материалов и гарантируют бережное устранение стойких загрязнений. Конструкцией люка предусмотрена манжета, предупреждающая развитие бактерий. Выбранные настройки сохраняются во встроенной памяти.', 'category_id' => 1, 'sub_category_id' => 2],
            ['name' => 'Стиральная машина LG F2V5HS2S', 'image' => public_path('img/seeds/product/washing_machine/lg_f2'), 'price' => 38999, 'description' => 'Стиральная машина LG F2V5HS2S с фронтальной загрузкой вмещает 7 кг белья. Модель оснащена 14-ю автоматическими программами и возможностью ручной настройки температуры и скорости отжима. Есть удобные функции отсрочки запуска и блокировки панели управления. Системы автовзвешивания и контроля пенообразования делают стирку еще удобнее.', 'category_id' => 1, 'sub_category_id' => 2],

            ['name' => 'Посудомоечная машина Eigen F451W', 'image' => public_path('img/seeds/product/dishwashes/eigen.webp'), 'price' => 24199, 'description' => 'Посудомоечная машина Eigen F451W оснащена тремя вместительными корзинами, которые предусматривают загрузку до 10 комплектов посуды. Бак из нержавеющей стали устойчив к появлению коррозии и повреждениям. В модели реализованы 8 автоматических программ, рассчитанные на разную загрузку и степень загрязненности посуды.', 'category_id' => 1, 'sub_category_id' => 3],
            ['name' => 'Посудомоечная машина Midea MFD45S050S', 'image' => public_path('img/seeds/product/dishwashes/midea_mfd4.webp'), 'price' => 24999, 'description' => 'Отдельностоящая посудомоечная машина Midea MFD45S050S вмещает до 9 комплектов посуды благодаря двум корзинам. Устройство предлагает 6 различных программ для эффективной мойки посуды, а также режим половинной загрузки для экономии воды и энергии. Машина оснащена частичной защитой от протечек, которая охватывает только шланг. Для удобства использования предусмотрены автооткрывание дверцы и блокировка от детей.', 'category_id' => 1, 'sub_category_id' => 3],
            ['name' => 'Посудомоечная машина Indesit DF 5C85 D', 'image' => public_path('img/seeds/product/dishwashes/indesit_df.webp'), 'price' => 33999, 'description' => 'Посудомоечная машина Indesit DF 5C85 D предлагает 8 автоматических программ для мытья столовых приборов. Внутри расположены 3 корзины с возможностью регулировки высоты. Они рассчитаны на загрузку до 15 комплектов посуды. Бак из нержавеющей стали устойчив к механических повреждениям и коррозии.', 'category_id' => 1, 'sub_category_id' => 3],
            ['name' => 'Посудомоечная машина Gorenje GS541D10X', 'image' => public_path('img/seeds/product/dishwashes/gorenje.webp'), 'price' => 43499, 'description' => 'Посудомоечная машина Gorenje GS541D10X выполнит надоевшую, но важную работу лучше вас. Техника вмещает 11 комплектов посуды, за 1 цикл расходуя 706 Вт∙ч т 9.5 л воды. Вы сами настраиваете по высоте 3 корзины, используете отдельные полочки для чашек и складные стойки. Прибор с инверторным мотором и сенсором чистоты воды гарантирует аккуратную и эффективную мойку даже бокалов и прочей хрупкой посуды.', 'category_id' => 1, 'sub_category_id' => 3],


            ['name' => 'Процессор AMD Ryzen 5 5600', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 10499, 'description' => 'Процессор AMD Ryzen 5 5600 OEM...', 'category_id' => 7, 'sub_category_id' => 31],
            ['name' => 'Процессор AMD Ryzen 7 7800X3D', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 28899, 'description' => '8-ядерный процессор AMD Ryzen 7 7800X3D OEM...', 'category_id' => 7, 'sub_category_id' => 31],
            ['name' => 'Процессор Intel Core i5-12400F', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 13299, 'description' => 'Процессор Intel Core i5-12400F OEM...', 'category_id' => 7, 'sub_category_id' => 31],
            ['name' => 'Процессор AMD Ryzen 7 5700X', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 14999, 'description' => '...', 'category_id' => 7, 'sub_category_id' => 31],
            ['name' => 'Процессор Intel Core i3-12100', 'image' => public_path('img/seeds/r5_5600.jpg'), 'price' => 15699, 'description' => '...', 'category_id' => 7, 'sub_category_id' => 31],
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
