<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addresses = [
            ['name' => 'Ул. Циолковского 13'],
            ['name' => 'Ул. Ленина 72'],
            ['name' => 'Ул. Мира 52'],
        ];

        foreach ($addresses as $address) {
            Address::create(['name' => $address['name']]);
        }
    }
}
