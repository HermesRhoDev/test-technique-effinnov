<?php

namespace Tests\Feature;

use App\Core\Inventory\Enums\ComponentType;
use App\Models\Component;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class PublicCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_catalog_page_is_accessible()
    {
        $response = $this->get('/catalog');

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Catalog/Index')
        );
    }

    public function test_public_catalog_lists_components()
    {
        // Create some components
        Component::factory()->count(3)->create();

        $response = $this->get('/catalog');

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Catalog/Index')
            ->has('components.data', 3)
        );
    }

    public function test_public_catalog_can_be_filtered_by_type()
    {
        Component::factory()->create(['type' => ComponentType::RESISTOR]);
        Component::factory()->create(['type' => ComponentType::CAPACITOR]);

        $response = $this->get('/catalog?type=resistor');

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Catalog/Index')
            ->has('components.data', 1)
            ->where('components.data.0.type', 'resistor')
        );
    }

    public function test_public_catalog_detail_page_works()
    {
        $component = Component::factory()->create([
            'name' => 'Test Component',
            'reference' => 'REF123'
        ]);

        $response = $this->get('/catalog/' . $component->reference);

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Catalog/Show')
            ->where('component.name', 'Test Component')
            ->where('component.reference', 'REF123')
        );
    }

    public function test_public_catalog_detail_page_returns_404_for_unknown_component()
    {
        $response = $this->get('/catalog/UNKNOWN-REF');

        $response->assertStatus(404);
    }
}
