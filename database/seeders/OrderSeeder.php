<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $providerIds = DB::table('providers')->pluck('id')->toArray();
        $patientIds = DB::table('patients')->pluck('id')->toArray();
        $inventoryIds = DB::table('inventories')->pluck('id')->toArray();

        foreach (range(1, 10) as $i) {
            $providerId = $faker->randomElement($providerIds);
            $patientId = $faker->randomElement($patientIds);
            $inventoryId = $faker->randomElement($inventoryIds);
            $quantity = $faker->numberBetween(1, 5);
            $price = DB::table('inventories')->where('id', $inventoryId)->value('price');
            $total = $quantity * $price;

            DB::table('orders')->insert([
                'provider_id' => $providerId,
                'patient_id' => $patientId,
                'inventory_id' => $inventoryId,
                'quantity' => $quantity,
                'total' => $total,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ 10 Orders inserted successfully!');
    }
}
