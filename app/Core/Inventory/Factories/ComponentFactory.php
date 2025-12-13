<?php

namespace App\Core\Inventory\Factories;

use App\Core\Inventory\Enums\ComponentType;
use App\Core\Inventory\Interfaces\ElectronicComponentInterface;
use App\Core\Inventory\Models\Capacitor;
use App\Core\Inventory\Models\Microcontroller;
use App\Core\Inventory\Models\Resistor;

class ComponentFactory
{
    /**
     * @throws \InvalidArgumentException
     */
    public static function create(ComponentType $type, array $data): ElectronicComponentInterface
    {
        // Required fields
        if (!isset($data['name'], $data['reference'], $data['price'])) {
            throw new \InvalidArgumentException("Missing required common fields (name, reference, price)");
        }

        $stock = $data['stock'] ?? 0;

        return match ($type) {
            ComponentType::RESISTOR => new Resistor(
                $data['name'],
                $data['reference'],
                (float)$data['price'],
                $data['resistance_value'] ?? 'Unknown',
                $data['power_rating'] ?? 'Unknown',
                $stock
            ),
            ComponentType::CAPACITOR => new Capacitor(
                $data['name'],
                $data['reference'],
                (float)$data['price'],
                $data['capacitance_value'] ?? 'Unknown',
                $data['voltage_rating'] ?? 'Unknown',
                $stock
            ),
            ComponentType::MICROCONTROLLER => new Microcontroller(
                $data['name'],
                $data['reference'],
                (float)$data['price'],
                $data['clock_speed'] ?? 'Unknown',
                $data['architecture'] ?? 'Unknown',
                (int)($data['gpio_count'] ?? 0),
                $stock
            ),
        };
    }
}
