<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProviderSeeder extends Seeder
{
   public function run(): void
{
    // Create 10 providers, each with a linked user
    \App\Models\Provider::factory()
        ->count(10)
        ->create();

    $this->command->info('✅ 10 Providers inserted successfully!');
}

}
