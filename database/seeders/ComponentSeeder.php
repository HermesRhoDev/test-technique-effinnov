<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Component;
use App\Core\Inventory\Enums\ComponentType;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Component::create([
            'name' => 'Résistance 10k',
            'reference' => 'RES-10K-001',
            'price' => 0.10,
            'stock' => 100,
            'type' => ComponentType::RESISTOR,
            'specifications' => [
                'resistance_value' => '10k',
                'power_rating' => '0.25W'
            ],
        ]);

        Component::create([
            'name' => 'Condensateur 100uF',
            'reference' => 'CAP-100U-001',
            'price' => 0.50,
            'stock' => 50,
            'type' => ComponentType::CAPACITOR,
            'specifications' => [
                'capacitance_value' => '100uF',
                'voltage_rating' => '16V'
            ],
        ]);

        Component::create([
            'name' => 'Arduino Uno',
            'reference' => 'MC-UNO-001',
            'price' => 25.00,
            'stock' => 10,
            'type' => ComponentType::MICROCONTROLLER,
            'specifications' => [
                'clock_speed' => '16MHz',
                'architecture' => 'AVR',
                'gpio_count' => 14
            ],
        ]);
    }
}
