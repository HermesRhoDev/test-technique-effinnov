<?php

namespace App\Http\Controllers;

use App\Core\Inventory\Enums\ComponentType;
use App\Core\Inventory\Services\InventoryManager;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PublicCatalogController extends Controller
{
    private InventoryManager $inventoryManager;

    public function __construct(InventoryManager $inventoryManager)
    {
        $this->inventoryManager = $inventoryManager;
    }

    public function index(Request $request): Response
    {
        $type = null;
        if ($request->has('type') && $request->input('type') !== '') {
            try {
                $type = ComponentType::from($request->input('type'));
            } catch (\ValueError $e) {}
        }

        $paginator = $this->inventoryManager->getPaginatedComponents(12, $type);

        /** @var \Illuminate\Pagination\LengthAwarePaginator $paginator */
        $paginator->getCollection()->transform(fn($c) => [
            'name' => $c->getName(),
            'reference' => $c->getReference(),
            'price' => $c->getPrice(),
            'stock' => $c->getStock(),
            'type' => $c->getType()->value,
            'specifications' => $c->getSpecifications(),
            'formatted_specs' => $c->getFormattedSpecs(),
        ]);

        return Inertia::render('Catalog/Index', [
            'components' => $paginator,
            'filters' => $request->only(['type']),
            'types' => array_column(ComponentType::cases(), 'value'),
        ]);
    }

    public function show(string $reference): Response
    {
        $component = $this->inventoryManager->getComponent($reference);

        if (!$component) {
            abort(404);
        }

        return Inertia::render('Catalog/Show', [
            'component' => [
                'name' => $component->getName(),
                'reference' => $component->getReference(),
                'price' => $component->getPrice(),
                'stock' => $component->getStock(),
                'type' => $component->getType()->value,
                'specifications' => $component->getSpecifications(),
                'formatted_specs' => $component->getFormattedSpecs(),
            ],
        ]);
    }
}
