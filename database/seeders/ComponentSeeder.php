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
        // Clean datas before seeding
        Component::truncate();

        $components = [
            // --- RESISTORS ---
            [
                'name' => 'Résistance 100Ω 1/4W',
                'reference' => 'RES-100R-025',
                'price' => 0.05,
                'stock' => 500,
                'type' => ComponentType::RESISTOR,
                'specifications' => ['resistance_value' => '100Ω', 'power_rating' => '0.25W'],
            ],
            [
                'name' => 'Résistance 220Ω 1/4W',
                'reference' => 'RES-220R-025',
                'price' => 0.05,
                'stock' => 450,
                'type' => ComponentType::RESISTOR,
                'specifications' => ['resistance_value' => '220Ω', 'power_rating' => '0.25W'],
            ],
            [
                'name' => 'Résistance 330Ω 1/4W',
                'reference' => 'RES-330R-025',
                'price' => 0.05,
                'stock' => 300,
                'type' => ComponentType::RESISTOR,
                'specifications' => ['resistance_value' => '330Ω', 'power_rating' => '0.25W'],
            ],
            [
                'name' => 'Résistance 1kΩ 1/4W',
                'reference' => 'RES-1K-025',
                'price' => 0.05,
                'stock' => 1000,
                'type' => ComponentType::RESISTOR,
                'specifications' => ['resistance_value' => '1kΩ', 'power_rating' => '0.25W'],
            ],
            [
                'name' => 'Résistance 4.7kΩ 1/4W',
                'reference' => 'RES-4K7-025',
                'price' => 0.05,
                'stock' => 800,
                'type' => ComponentType::RESISTOR,
                'specifications' => ['resistance_value' => '4.7kΩ', 'power_rating' => '0.25W'],
            ],
            [
                'name' => 'Résistance 10kΩ 1/4W',
                'reference' => 'RES-10K-025',
                'price' => 0.05,
                'stock' => 1200,
                'type' => ComponentType::RESISTOR,
                'specifications' => ['resistance_value' => '10kΩ', 'power_rating' => '0.25W'],
            ],
            [
                'name' => 'Résistance 100kΩ 1/4W',
                'reference' => 'RES-100K-025',
                'price' => 0.05,
                'stock' => 600,
                'type' => ComponentType::RESISTOR,
                'specifications' => ['resistance_value' => '100kΩ', 'power_rating' => '0.25W'],
            ],
            [
                'name' => 'Résistance Puissance 10Ω 5W',
                'reference' => 'RES-10R-5W',
                'price' => 0.85,
                'stock' => 50,
                'type' => ComponentType::RESISTOR,
                'specifications' => ['resistance_value' => '10Ω', 'power_rating' => '5W'],
            ],

            // --- CAPACITORS ---
            [
                'name' => 'Condensateur Céramique 22pF',
                'reference' => 'CAP-CER-22P',
                'price' => 0.02,
                'stock' => 200,
                'type' => ComponentType::CAPACITOR,
                'specifications' => ['capacitance_value' => '22pF', 'voltage_rating' => '50V'],
            ],
            [
                'name' => 'Condensateur Céramique 100nF',
                'reference' => 'CAP-CER-100N',
                'price' => 0.03,
                'stock' => 1500,
                'type' => ComponentType::CAPACITOR,
                'specifications' => ['capacitance_value' => '100nF', 'voltage_rating' => '50V'],
            ],
            [
                'name' => 'Condensateur Chimique 10µF',
                'reference' => 'CAP-EL-10U',
                'price' => 0.10,
                'stock' => 300,
                'type' => ComponentType::CAPACITOR,
                'specifications' => ['capacitance_value' => '10µF', 'voltage_rating' => '25V'],
            ],
            [
                'name' => 'Condensateur Chimique 100µF',
                'reference' => 'CAP-EL-100U',
                'price' => 0.15,
                'stock' => 250,
                'type' => ComponentType::CAPACITOR,
                'specifications' => ['capacitance_value' => '100µF', 'voltage_rating' => '25V'],
            ],
            [
                'name' => 'Condensateur Chimique 470µF',
                'reference' => 'CAP-EL-470U',
                'price' => 0.25,
                'stock' => 100,
                'type' => ComponentType::CAPACITOR,
                'specifications' => ['capacitance_value' => '470µF', 'voltage_rating' => '35V'],
            ],
            [
                'name' => 'Condensateur Chimique 1000µF',
                'reference' => 'CAP-EL-1000U',
                'price' => 0.45,
                'stock' => 80,
                'type' => ComponentType::CAPACITOR,
                'specifications' => ['capacitance_value' => '1000µF', 'voltage_rating' => '16V'],
            ],

            // --- MICROCONTROLLERS ---
            [
                'name' => 'Arduino Uno R3',
                'reference' => 'MC-UNO-R3',
                'price' => 24.90,
                'stock' => 15,
                'type' => ComponentType::MICROCONTROLLER,
                'specifications' => ['clock_speed' => '16MHz', 'architecture' => 'AVR', 'gpio_count' => 14],
            ],
            [
                'name' => 'Arduino Nano',
                'reference' => 'MC-NANO',
                'price' => 18.50,
                'stock' => 25,
                'type' => ComponentType::MICROCONTROLLER,
                'specifications' => ['clock_speed' => '16MHz', 'architecture' => 'AVR', 'gpio_count' => 22],
            ],
            [
                'name' => 'ESP32 DevKit V1',
                'reference' => 'MC-ESP32',
                'price' => 8.90,
                'stock' => 40,
                'type' => ComponentType::MICROCONTROLLER,
                'specifications' => ['clock_speed' => '240MHz', 'architecture' => 'Xtensa LX6', 'gpio_count' => 34],
            ],
            [
                'name' => 'Raspberry Pi Pico',
                'reference' => 'MC-PICO',
                'price' => 4.50,
                'stock' => 60,
                'type' => ComponentType::MICROCONTROLLER,
                'specifications' => ['clock_speed' => '133MHz', 'architecture' => 'ARM Cortex-M0+', 'gpio_count' => 26],
            ],
            [
                'name' => 'STM32 Blue Pill',
                'reference' => 'MC-STM32F103',
                'price' => 6.20,
                'stock' => 30,
                'type' => ComponentType::MICROCONTROLLER,
                'specifications' => ['clock_speed' => '72MHz', 'architecture' => 'ARM Cortex-M3', 'gpio_count' => 37],
            ],
            [
                'name' => 'Microchip PIC16F877A',
                'reference' => 'MC-PIC16F',
                'price' => 5.80,
                'stock' => 20,
                'type' => ComponentType::MICROCONTROLLER,
                'specifications' => ['clock_speed' => '20MHz', 'architecture' => 'PIC', 'gpio_count' => 33],
            ],
        ];

        foreach ($components as $data) {
            // Update or create component
            Component::updateOrCreate(
                ['reference' => $data['reference']],
                $data
            );
        }
    }
}
