<?php

namespace App\Core\Inventory\Models;

use App\Core\Inventory\Enums\ComponentType;

class Resistor extends AbstractComponent
{
    private string $resistanceValue;
    private string $powerRating;

    public function __construct(
        string $name,
        string $reference,
        float $price,
        string $resistanceValue,
        string $powerRating,
        int $stock = 0
    ) {
        parent::__construct($name, $reference, $price, $stock);
        $this->resistanceValue = $resistanceValue;
        $this->powerRating = $powerRating;
    }

    public function getType(): ComponentType
    {
        return ComponentType::RESISTOR;
    }

    public function getSpecifications(): array
    {
        return [
            'resistance_value' => $this->resistanceValue,
            'power_rating' => $this->powerRating,
        ];
    }

    public function getFormattedSpecs(): string
    {
        return "Resistance: {$this->resistanceValue}, Power: {$this->powerRating}";
    }
}
