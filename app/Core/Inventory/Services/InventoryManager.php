<?php

namespace App\Core\Inventory\Services;

use App\Core\Inventory\Enums\ComponentType;
use App\Core\Inventory\Factories\ComponentFactory;
use App\Core\Inventory\Interfaces\ElectronicComponentInterface;
use App\Models\Component as ComponentModel;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InventoryManager
{
    public function addComponent(ElectronicComponentInterface $component): void
    {
        if (ComponentModel::where('reference', $component->getReference())->exists()) {
            throw new \RuntimeException("Component with reference {$component->getReference()} already exists.");
        }

        ComponentModel::create([
            'name' => $component->getName(),
            'reference' => $component->getReference(),
            'price' => $component->getPrice(),
            'stock' => $component->getStock(),
            'type' => $component->getType(),
            'specifications' => $component->getSpecifications(),
        ]);
    }

    public function getComponent(string $reference): ?ElectronicComponentInterface
    {
        $model = ComponentModel::where('reference', $reference)->first();

        if (!$model) {
            return null;
        }

        return $this->modelToDomainObject($model);
    }

    public function updateComponent(string $originalReference, ElectronicComponentInterface $updatedComponent): void
    {
        $model = ComponentModel::where('reference', $originalReference)->first();

        if (!$model) {
            throw new \RuntimeException("Component with reference {$originalReference} not found.");
        }

        // Check if new reference already exists (if changed)
        if ($originalReference !== $updatedComponent->getReference() &&
            ComponentModel::where('reference', $updatedComponent->getReference())->exists()) {
            throw new \RuntimeException("Component with reference {$updatedComponent->getReference()} already exists.");
        }

        $model->update([
            'name' => $updatedComponent->getName(),
            'reference' => $updatedComponent->getReference(),
            'price' => $updatedComponent->getPrice(),
            'stock' => $updatedComponent->getStock(),
            'type' => $updatedComponent->getType(),
            'specifications' => $updatedComponent->getSpecifications(),
        ]);
    }

    public function removeComponent(string $reference): void
    {
        ComponentModel::where('reference', $reference)->delete();
    }

    /**
     * @return ElectronicComponentInterface[]
     */
    public function getAllComponents(?ComponentType $type = null): array
    {
        $query = ComponentModel::query();

        if ($type) {
            $query->where('type', $type);
        }

        return $query->get()
            ->map(fn ($model) => $this->modelToDomainObject($model))
            ->all();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedComponents(int $perPage = 10, ?ComponentType $type = null): LengthAwarePaginator
    {
        $query = ComponentModel::query();

        if ($type) {
            $query->where('type', $type);
        }

        $paginator = $query->paginate($perPage);

        $paginator->getCollection()->transform(function ($model) {
            return $this->modelToDomainObject($model);
        });

        return $paginator;
    }

    /**
     * @return ElectronicComponentInterface[]
     */
    public function getComponentsByType(ComponentType $type): array
    {
        return ComponentModel::where('type', $type)
            ->get()
            ->map(fn ($model) => $this->modelToDomainObject($model))
            ->all();
    }

    private function modelToDomainObject(ComponentModel $model): ElectronicComponentInterface
    {
        $data = array_merge(
            [
                'name' => $model->name,
                'reference' => $model->reference,
                'price' => $model->price,
                'stock' => $model->stock,
            ],
            $model->specifications ?? []
        );

        return ComponentFactory::create($model->type, $data);
    }
}
