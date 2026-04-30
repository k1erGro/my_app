<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\AddressProduct;
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

        $address_products = [
            ['address_id' => 1, 'product_id' => 1, 'product_quantity' => 10],
            ['address_id' => 1, 'product_id' => 2, 'product_quantity' => 21],
            ['address_id' => 1, 'product_id' => 3, 'product_quantity' => 17],
            ['address_id' => 2, 'product_id' => 1, 'product_quantity' => 12],
            ['address_id' => 2, 'product_id' => 2, 'product_quantity' => 5],
            ['address_id' => 3, 'product_id' => 3, 'product_quantity' => 7],
        ];

        foreach ($address_products as $addresses_product) {
            AddressProduct::create(['address_id' => $addresses_product['address_id'], 'product_id' => $addresses_product['product_id'], 'product_quantity' => $addresses_product['product_quantity']]);
        }
    }
}
