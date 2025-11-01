<?php

namespace Tests\Feature;

use App\Models\Provider;
use App\Models\Patient;
use App\Models\Inventory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InsufficientStockTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_409_when_insufficient_stock()
    {
        $provider = Provider::factory()->create();
        $user = $provider->user;
        $inventory = Inventory::factory()->create(['quantity' => 2, 'price' => 100]);
        $patient = Patient::factory()->create();

        $payload = [
            'provider_id'  => $provider->id,
            'inventory_id' => $inventory->id,
            'patient_id'   => $patient->id,
            'quantity'     => 5, // greater than stock
        ];

        $response = $this->actingAs($user)->postJson('/api/orders', $payload);

        $response->assertStatus(409);
    }
}
