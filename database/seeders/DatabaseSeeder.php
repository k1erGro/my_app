<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'last_name' => 'Admin',
            'first_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('qwe123'),
            'birthday' => '2000-01-01',
            'phone' => '+7 (123) 456-78-90',
            'address' => 'test address',
            'role' => 'admin',
        ]);
    }
}
