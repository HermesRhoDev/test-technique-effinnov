<?php

namespace App\Models;

use App\Core\Inventory\Enums\ComponentType;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $fillable = [
        'name',
        'reference',
        'price',
        'stock',
        'type',
        'specifications',
    ];

    protected $casts = [
        'type' => ComponentType::class,
        'specifications' => 'array',
        'price' => 'decimal:2',
    ];
}
