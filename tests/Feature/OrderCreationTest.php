<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Provider;
use App\Models\Patient;
use App\Models\Inventory;
use App\Events\OrderPlaced;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_provider_can_create_an_order_successfully()
    {
        Event::fake();

        $provider = Provider::factory()->create();
        $user = $provider->user;
        $inventory = Inventory::factory()->create(['quantity' => 10, 'price' => 100]);
        $patient = Patient::factory()->create();

        $payload = [
            'provider_id'  => $provider->id,
            'inventory_id' => $inventory->id,
            'patient_id'   => $patient->id,
            'quantity'     => 3,
        ];

        $response = $this->actingAs($user)->postJson('/api/orders', $payload);

        $response->assertStatus(201);

        $this->assertDatabaseHas('orders', [
            'provider_id'  => $provider->id,
            'inventory_id' => $inventory->id,
            'quantity'     => 3,
        ]);

        $this->assertEquals(7, $inventory->fresh()->quantity);
        Event::assertDispatched(OrderPlaced::class);
    }
}
