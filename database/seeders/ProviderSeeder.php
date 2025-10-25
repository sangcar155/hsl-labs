<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProviderSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Insert 10 fake providers
        foreach (range(1, 10) as $i) {
            DB::table('providers')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'clinic_name' => $faker->company,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // confirmation in console
        $this->command->info('✅ 10 Providers inserted successfully!');
    }
}
