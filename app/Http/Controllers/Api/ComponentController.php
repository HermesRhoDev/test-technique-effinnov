<?php

namespace App\Http\Controllers\Api;

use App\Core\Inventory\Enums\ComponentType;
use App\Core\Inventory\Factories\ComponentFactory;
use App\Core\Inventory\Services\InventoryManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComponentRequest;
use App\Http\Requests\UpdateComponentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ComponentController extends Controller
{
    private InventoryManager $inventoryManager;

    public function __construct(InventoryManager $inventoryManager)
    {
        $this->inventoryManager = $inventoryManager;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $type = null;
        if ($request->has('type')) {
            try {
                $type = ComponentType::from($request->query('type'));
            } catch (\ValueError $e) {
                return response()->json(['error' => 'Invalid component type'], 400);
            }
        }

        $components = $this->inventoryManager->getAllComponents($type);

        // Transform domain objects to array for JSON response
        $data = array_map(fn($c) => $this->formatComponent($c), $components);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComponentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $type = ComponentType::from($validated['type']);

            // Create domain object via Factory (validates business logic)
            $component = ComponentFactory::create($type, $validated);

            // Persist via Manager
            $this->inventoryManager->addComponent($component);

            return response()->json($this->formatComponent($component), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $reference): JsonResponse
    {
        $component = $this->inventoryManager->getComponent($reference);

        if (!$component) {
            return response()->json(['error' => 'Component not found'], 404);
        }

        return response()->json($this->formatComponent($component));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComponentRequest $request, string $reference): JsonResponse
    {
        $component = $this->inventoryManager->getComponent($reference);

        if (!$component) {
            return response()->json(['error' => 'Component not found'], 404);
        }

        $validated = $request->validated();

        try {
            $type = ComponentType::from($validated['type']);

            // Create domain object with updated values
            $updatedComponent = ComponentFactory::create($type, $validated);

            // Update via Manager
            $this->inventoryManager->updateComponent($reference, $updatedComponent);

            return response()->json($this->formatComponent($updatedComponent));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $reference): JsonResponse
    {
        $component = $this->inventoryManager->getComponent($reference);

        if (!$component) {
            return response()->json(['error' => 'Component not found'], 404);
        }

        $this->inventoryManager->removeComponent($reference);

        return response()->json(null, 204);
    }

    private function formatComponent($component): array
    {
        return [
            'name' => $component->getName(),
            'reference' => $component->getReference(),
            'price' => $component->getPrice(),
            'stock' => $component->getStock(),
            'type' => $component->getType()->value,
            'specifications' => $component->getSpecifications(),
            'formatted_specs' => $component->getFormattedSpecs(),
        ];
    }
}
