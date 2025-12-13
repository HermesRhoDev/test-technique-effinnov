<?php

namespace App\Http\Controllers;

use App\Core\Inventory\Enums\ComponentType;
use App\Core\Inventory\Factories\ComponentFactory;
use App\Core\Inventory\Services\InventoryManager;
use App\Http\Requests\StoreComponentRequest;
use App\Http\Requests\UpdateComponentRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class InventoryController extends Controller
{
    private InventoryManager $inventoryManager;

    public function __construct(InventoryManager $inventoryManager)
    {
        $this->inventoryManager = $inventoryManager;
    }

    public function index(): Response
    {
        $components = $this->inventoryManager->getAllComponents();

        $data = array_map(fn($c) => [
            'name' => $c->getName(),
            'reference' => $c->getReference(),
            'price' => $c->getPrice(),
            'stock' => $c->getStock(),
            'type' => $c->getType()->value,
            'specifications' => $c->getSpecifications(),
        ], $components);

        return Inertia::render('Inventory/Index', [
            'components' => $data
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Inventory/Create', [
            'types' => array_column(ComponentType::cases(), 'value')
        ]);
    }

    public function store(StoreComponentRequest $request)
    {
        $validated = $request->validated();

        $type = ComponentType::from($validated['type']);
        $component = ComponentFactory::create($type, $validated);
        $this->inventoryManager->addComponent($component);

        return to_route('inventory.index')->with('success', 'Component created successfully.');
    }

    public function edit(string $reference): Response
    {
        $component = $this->inventoryManager->getComponent($reference);

        if (!$component) {
            abort(404);
        }

        return Inertia::render('Inventory/Edit', [
            'component' => [
                'name' => $component->getName(),
                'reference' => $component->getReference(),
                'price' => $component->getPrice(),
                'stock' => $component->getStock(),
                'type' => $component->getType()->value,
                ...$component->getSpecifications(),
            ],
            'types' => array_column(ComponentType::cases(), 'value')
        ]);
    }

    public function update(UpdateComponentRequest $request, string $reference)
    {
        $validated = $request->validated();

        $type = ComponentType::from($validated['type']);
        $component = ComponentFactory::create($type, $validated);

        $this->inventoryManager->updateComponent($reference, $component);

        return to_route('inventory.index')->with('success', 'Component updated successfully.');
    }

    public function destroy(string $reference)
    {
        $this->inventoryManager->removeComponent($reference);
        return to_route('inventory.index')->with('success', 'Component deleted successfully.');
    }
}
