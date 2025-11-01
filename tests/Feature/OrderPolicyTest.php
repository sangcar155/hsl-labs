<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Provider;
use App\Models\Inventory;
use App\Models\Patient;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_provider_cannot_create_an_order()
    {
        $nonProvider = User::factory()->create(['role' => 'patient']);
        $provider = Provider::factory()->create();
        $inventory = Inventory::factory()->create();
        $patient = Patient::factory()->create();

        $payload = [
            'provider_id'  => $provider->id,
            'inventory_id' => $inventory->id,
            'patient_id'   => $patient->id,
            'quantity'     => 1,
        ];

        $response = $this->actingAs($nonProvider)->postJson('/api/orders', $payload);

        $response->assertStatus(403);
    }
}
