<?php

require __DIR__ . '/vendor/autoload.php';

use App\Core\Inventory\Enums\ComponentType;
use App\Core\Inventory\Factories\ComponentFactory;
use App\Core\Inventory\Services\InventoryManager;

echo "--- Test POO Inventory System ---\n";

$manager = new InventoryManager();

try {
    // Factory creation
    $resistor = ComponentFactory::create(ComponentType::RESISTOR, [
        'name' => 'Résistance 10k',
        'reference' => 'RES-10K-001',
        'price' => 0.10,
        'stock' => 100,
        'resistance_value' => '10k Ohm',
        'power_rating' => '0.25W'
    ]);

    $capacitor = ComponentFactory::create(ComponentType::CAPACITOR, [
        'name' => 'Condensateur 100µF',
        'reference' => 'CAP-100U-001',
        'price' => 0.50,
        'stock' => 50,
        'capacitance_value' => '100µF',
        'voltage_rating' => '16V'
    ]);

    $micro = ComponentFactory::create(ComponentType::MICROCONTROLLER, [
        'name' => 'ATmega328P',
        'reference' => 'MCU-ATM-001',
        'price' => 2.50,
        'stock' => 10,
        'clock_speed' => '16MHz',
        'architecture' => 'AVR',
        'gpio_count' => 23
    ]);

    // Adding components to the manager
    $manager->addComponent($resistor);
    $manager->addComponent($capacitor);
    $manager->addComponent($micro);

    echo "✅ Composants ajoutés avec succès.\n";

    // Stock manipulation
    $resistor->addStock(50);
    echo "✅ Stock résistance mis à jour: " . $resistor->getStock() . " (Attendu: 150)\n";

    $resistor->removeStock(10);
    echo "✅ Stock résistance mis à jour: " . $resistor->getStock() . " (Attendu: 90)\n";

    // Listing by type
    $mcus = $manager->getComponentsByType(ComponentType::MICROCONTROLLER);
    echo "✅ Nombre de microcontrôleurs trouvés: " . count($mcus) . "\n";

    foreach ($mcus as $mcu) {
        print_r($mcu->getSpecifications());
    }

} catch (\Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
