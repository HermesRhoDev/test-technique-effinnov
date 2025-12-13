<?php

namespace App\Core\Inventory\Models;

use App\Core\Inventory\Enums\ComponentType;

class Capacitor extends AbstractComponent
{
    private string $capacitanceValue;
    private string $voltageRating;

    public function __construct(
        string $name,
        string $reference,
        float $price,
        string $capacitanceValue,
        string $voltageRating,
        int $stock = 0
    ) {
        parent::__construct($name, $reference, $price, $stock);
        $this->capacitanceValue = $capacitanceValue;
        $this->voltageRating = $voltageRating;
    }

    public function getType(): ComponentType
    {
        return ComponentType::CAPACITOR;
    }

    public function getSpecifications(): array
    {
        return [
            'capacitance_value' => $this->capacitanceValue,
            'voltage_rating' => $this->voltageRating,
        ];
    }

    public function getFormattedSpecs(): string
    {
        return "Capacitance: {$this->capacitanceValue}, Voltage: {$this->voltageRating}";
    }
}
