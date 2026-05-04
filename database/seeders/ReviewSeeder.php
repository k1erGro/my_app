<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\AddressProduct;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            ['user_id' => 11, 'product_id' => 1, 'review' => 'blablabla', 'rating' => 5],
            ['user_id' => 11, 'product_id' => 2, 'review' => 'blablabla', 'rating' => 4],
            ['user_id' => 11, 'product_id' => 3, 'review' => 'blablabla', 'rating' => 3],
            ['user_id' => 1, 'product_id' => 1, 'review' => 'blablabla', 'rating' => 1],
            ['user_id' => 1, 'product_id' => 2, 'review' => 'blablabla', 'rating' => 2],
            ['user_id' => 1, 'product_id' => 3, 'review' => 'blablabla', 'rating' => 5],
            ['user_id' => 2, 'product_id' => 1, 'review' => 'blablabla', 'rating' => 3],

        ];

        foreach ($reviews as $review) {
            Review::create(['user_id' => $review['user_id'], 'product_id' => $review['product_id'], 'review' => $review['review'], 'rating' => $review['rating']]);
        }

    }
}
