<?php

namespace App\Core\Inventory\Models;

use App\Core\Inventory\Enums\ComponentType;

class Microcontroller extends AbstractComponent
{
    private string $clockSpeed;
    private string $architecture;
    private int $gpioCount;

    public function __construct(
        string $name,
        string $reference,
        float $price,
        string $clockSpeed,
        string $architecture,
        int $gpioCount,
        int $stock = 0
    ) {
        parent::__construct($name, $reference, $price, $stock);
        $this->clockSpeed = $clockSpeed;
        $this->architecture = $architecture;
        $this->gpioCount = $gpioCount;
    }

    public function getType(): ComponentType
    {
        return ComponentType::MICROCONTROLLER;
    }

    public function getSpecifications(): array
    {
        return [
            'clock_speed' => $this->clockSpeed,
            'architecture' => $this->architecture,
            'gpio_count' => $this->gpioCount,
        ];
    }
}
