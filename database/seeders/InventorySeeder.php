<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Insert 10 fake inventory items
        foreach (range(1, 10) as $i) {
            DB::table('inventories')->insert([
                'product_name' => $faker->word,
                'quantity' => $faker->numberBetween(5, 50),
                'price' => $faker->randomFloat(2, 20, 500),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ 10 inventory items inserted successfully!');
    }
}
