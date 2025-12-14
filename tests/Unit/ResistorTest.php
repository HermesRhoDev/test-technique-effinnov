<?php

namespace Tests\Unit;

use App\Core\Inventory\Enums\ComponentType;
use App\Core\Inventory\Models\Resistor;
use PHPUnit\Framework\TestCase;

class ResistorTest extends TestCase
{
    public function test_resistor_can_be_created_and_returns_correct_data()
    {
        $resistor = new Resistor(
            'Test Resistor',
            'R100',
            0.50,
            '100 Ohm',
            '0.25W',
            100
        );

        $this->assertEquals('Test Resistor', $resistor->getName());
        $this->assertEquals('R100', $resistor->getReference());
        $this->assertEquals(0.50, $resistor->getPrice());
        $this->assertEquals(100, $resistor->getStock());
        $this->assertEquals(ComponentType::RESISTOR, $resistor->getType());

        $specs = $resistor->getSpecifications();
        $this->assertArrayHasKey('resistance_value', $specs);
        $this->assertArrayHasKey('power_rating', $specs);
        $this->assertEquals('100 Ohm', $specs['resistance_value']);
        $this->assertEquals('0.25W', $specs['power_rating']);

        $this->assertEquals('Resistance: 100 Ohm, Power: 0.25W', $resistor->getFormattedSpecs());
    }
}
