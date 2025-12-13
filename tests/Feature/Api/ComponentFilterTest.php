<?php

namespace Tests\Feature\Api;

use App\Core\Inventory\Enums\ComponentType;
use App\Models\Component;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ComponentFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_filter_components_by_type()
    {
        // Arrange
        // Create 3 resistors
        Component::factory()->count(3)->create([
            'type' => ComponentType::RESISTOR,
        ]);

        // Create 2 capacitors
        Component::factory()->count(2)->create([
            'type' => ComponentType::CAPACITOR,
        ]);

        // Create 1 microcontroller
        Component::factory()->count(1)->create([
            'type' => ComponentType::MICROCONTROLLER,
        ]);

        // Act & Assert: Filter by Resistor
        $responseResistors = $this->getJson('/api/components?type=resistor');
        $responseResistors->assertStatus(200)
            ->assertJsonCount(3);

        // Act & Assert: Filter by Capacitor
        $responseCapacitors = $this->getJson('/api/components?type=capacitor');
        $responseCapacitors->assertStatus(200)
            ->assertJsonCount(2);

        // Act & Assert: Filter by Microcontroller
        $responseMicro = $this->getJson('/api/components?type=microcontroller');
        $responseMicro->assertStatus(200)
            ->assertJsonCount(1);
            
        // Act & Assert: No Filter (should get all 6)
        $responseAll = $this->getJson('/api/components');
        $responseAll->assertStatus(200)
            ->assertJsonCount(6);
    }

    public function test_invalid_type_returns_error()
    {
        $response = $this->getJson('/api/components?type=invalid_type');
        $response->assertStatus(400)
            ->assertJson(['error' => 'Invalid component type']);
    }
}
