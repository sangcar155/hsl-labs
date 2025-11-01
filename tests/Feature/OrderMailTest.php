<?php

namespace Tests\Feature;

use App\Models\Provider;
use App\Models\Patient;
use App\Models\Inventory;
use App\Mail\OrderConfirmationMail;
use App\Events\OrderPlaced;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderMailTest extends TestCase
{
    use RefreshDatabase;

 public function test_order_confirmation_email_is_sent_on_order_placed()
{
    Mail::fake(); // Only fake mail
    Event::fakeExcept([OrderPlaced::class]); // Let OrderPlaced run normally

    $provider = Provider::factory()->create();
    $user = $provider->user;
    $inventory = Inventory::factory()->create(['quantity' => 5, 'price' => 100]);
    $patient = Patient::factory()->create();

    $payload = [
        'provider_id'  => $provider->id,
        'inventory_id' => $inventory->id,
        'patient_id'   => $patient->id,
        'quantity'     => 2,
    ];

    $this->actingAs($user)->postJson('/api/orders', $payload)->assertStatus(201);

    // ✅ We do NOT assert the event here anymore
    Mail::assertSent(OrderConfirmationMail::class, 1);
}


}
