<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

        $categories = Category::all();

        foreach ($categories as $category) {
            $products = Product::factory(10)->create();
            foreach ($products as $product) {
                $product->categories()->attach($category->id);
            }
        }


    }
}
