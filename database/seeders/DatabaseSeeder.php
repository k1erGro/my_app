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
        $users = User::factory(10)->create();

        foreach ($users as $user) {
            $user->assignRole('User');
        }



        User::factory()->create([
            'l_name' => 'Admin',
            'f_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'qwe123',
            'birthday' => '2000-01-01',
            'phone' => '+7 (123) 456-78-90',
            'address' => 'test address',
        ])->assignRole(RoleEnum::ADMIN);

        User::factory()->create([
            'l_name' => 'Admin',
            'f_name' => 'Admin',
            'email' => 'kirillnik522@gmail.com',
            'password' => 'qwe123',
            'birthday' => '2000-01-01',
            'phone' => '+7 (123) 456-78-90',
            'address' => 'test address',
        ])->assignRole(RoleEnum::USER);

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
