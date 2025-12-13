<?php

namespace App\Core\Inventory\Interfaces;

use App\Core\Inventory\Enums\ComponentType;

interface ElectronicComponentInterface
{
    public function getName(): string;
    public function getReference(): string;
    public function getPrice(): float;
    public function getStock(): int;
    public function getType(): ComponentType;
    public function getSpecifications(): array;
    public function getFormattedSpecs(): string;

    public function addStock(int $quantity): void;
    public function removeStock(int $quantity): void;
}
