<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get existing patients and inventory IDs
        $patientIds = DB::table('patients')->pluck('id')->toArray();
        $inventoryIds = DB::table('inventories')->pluck('id')->toArray();

        // Insert 10 fake subscriptions
        foreach (range(1, 10) as $i) {
            DB::table('subscriptions')->insert([
                'patient_id' => $faker->randomElement($patientIds),
                'inventory_id' => $faker->randomElement($inventoryIds),
                'next_due' => Carbon::now()->addDays($faker->numberBetween(15, 60))->format('Y-m-d'),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ 10 Subscriptions inserted successfully!');
    }
}
