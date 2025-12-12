<?php

namespace App\Core\Inventory\Enums;

enum ComponentType: string
{
    case RESISTOR = 'resistor';
    case CAPACITOR = 'capacitor';
    case MICROCONTROLLER = 'microcontroller';

    public function label(): string
    {
        return match($this) {
            self::RESISTOR => 'Résistance',
            self::CAPACITOR => 'Condensateur',
            self::MICROCONTROLLER => 'Microcontrôleur',
        };
    }
}
