<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'l_name' => 'Admin',
            'f_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'qwe123',
            'birthday' => '2000-01-01',
            'phone' => '+7 (123) 456-78-90',
            'address' => 'test address',
            'role' => 'admin',
        ]);

        $this->call(CategorySeeder::class);

        $categories = Category::all();

        foreach ($categories as $category) {
            Product::factory(10)->create([
                'category_id' => $category->id,
            ]);
        }

    }
}
