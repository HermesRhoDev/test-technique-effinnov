<?php

namespace App\Core\Inventory\Models;

use App\Core\Inventory\Enums\ComponentType;
use App\Core\Inventory\Interfaces\ElectronicComponentInterface;

abstract class AbstractComponent implements ElectronicComponentInterface
{
    protected string $name;
    protected string $reference;
    protected float $price;
    protected int $stock;

    public function __construct(
        string $name,
        string $reference,
        float $price,
        int $stock = 0
    ) {
        $this->name = $name;
        $this->reference = $reference;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function addStock(int $quantity): void
    {
        if ($quantity < 0) {
            throw new \InvalidArgumentException("Quantity to add must be positive");
        }
        $this->stock += $quantity;
    }

    public function removeStock(int $quantity): void
    {
        if ($quantity < 0) {
            throw new \InvalidArgumentException("Quantity to remove must be positive");
        }
        if ($this->stock < $quantity) {
            throw new \RuntimeException("Insufficient stock");
        }
        $this->stock -= $quantity;
    }

    // Force concrete classes to implement this
    abstract public function getType(): ComponentType;

    // Force concrete classes to implement this
    abstract public function getSpecifications(): array;

    // Force concrete classes to implement this
    abstract public function getFormattedSpecs(): string;
}
