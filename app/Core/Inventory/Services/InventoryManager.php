<?php

namespace App\Core\Inventory\Services;

use App\Core\Inventory\Enums\ComponentType;
use App\Core\Inventory\Interfaces\ElectronicComponentInterface;

class InventoryManager
{
    /**
     * @var array<string, ElectronicComponentInterface>
     */
    private array $components = [];

    public function addComponent(ElectronicComponentInterface $component): void
    {
        if (isset($this->components[$component->getReference()])) {
            throw new \RuntimeException("Component with reference {$component->getReference()} already exists.");
        }
        $this->components[$component->getReference()] = $component;
    }

    public function getComponent(string $reference): ?ElectronicComponentInterface
    {
        return $this->components[$reference] ?? null;
    }

    public function removeComponent(string $reference): void
    {
        unset($this->components[$reference]);
    }

    /**
     * @return ElectronicComponentInterface[]
     */
    public function getAllComponents(): array
    {
        return array_values($this->components);
    }

    /**
     * @return ElectronicComponentInterface[]
     */
    public function getComponentsByType(ComponentType $type): array
    {
        return array_filter(
            $this->components,
            fn (ElectronicComponentInterface $component) => $component->getType() === $type
        );
    }
}
