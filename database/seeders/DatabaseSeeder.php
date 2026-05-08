<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use App\Models\PropertyValue;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
        ]);


        User::factory()->create([
            'l_name' => 'Никитин',
            'f_name' => 'Кирилл',
            'm_name' => 'Анатольевич',
            'email' => 'kirillnik522@gmail.com',
            'password' => 'qwe123',
            'birthday' => '2006-07-28',
            'phone' => '+7 (123) 123-45-67',
            'address' => 'ул. Пархоменко 105'
        ])->assignRole(RoleEnum::TECHNICALSPECIALIST);

        User::factory()->create([
            'l_name' => 'Балакин',
            'f_name' => 'Сергей',
            'm_name' => 'Михайлович',
            'email' => 'silige3dmodel@gmail.com',
            'password' => 'qwe123',
            'birthday' => '2006-09-03',
            'phone' => '+7 (456) 123-45-67',
            'address' => 'ул. Ленина 28'
        ])->assignRole(RoleEnum::MANAGER);

        User::factory()->create([
            'l_name' => 'Алленов',
            'f_name' => 'Антон',
            'm_name' => 'Алексеевич',
            'email' => 'anton123@gmail.com',
            'password' => 'qwe123',
            'birthday' => '2006-09-03',
            'phone' => '+7 (789) 123-45-67',
            'address' => 'пр. Мира 53'
        ])->assignRole(RoleEnum::DIRECTOR);

        User::factory()->create([
            'l_name' => 'Калинин',
            'f_name' => 'Максим',
            'm_name' => 'Владимирович',
            'email' => 'kalina123@gmail.com',
            'password' => 'qwe123',
            'birthday' => '2006-08-08',
            'phone' => '+7 (123) 456-78-90',
            'address' => 'ул. Ленина 76'
        ])->assignRole(RoleEnum::USER);

        User::factory()->create([
            'l_name' => 'Admin',
            'f_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'qwe123',
            'birthday' => '2000-01-01',
            'phone' => '+7 (123) 456-78-90',
            'address' => 'test address',
        ])->assignRole(RoleEnum::ADMIN);

        $users = User::factory(10)->create();

        foreach ($users as $user) {
            $user->assignRole(RoleEnum::USER);
        }

        $this->call(CategorySeeder::class);
        $this->call(SubCategorySeeder::class);
        $this->call(PropertySeeder::class);
        Property::factory(100)->create();
        $this->call(ProductSeeder::class);

        Product::factory(200)->create();
        PropertyValue::factory(100)->create();

        $this->call(AddressSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ReviewSeeder::class);
        Review::factory(50)->create();


    }
}
