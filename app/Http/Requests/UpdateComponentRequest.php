<?php

namespace App\Http\Requests;

use App\Core\Inventory\Enums\ComponentType;
use App\Models\Component;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateComponentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the reference from the route parameter
        $reference = $this->route('reference') ?? $this->route('component');

        $componentId = null;
        if ($reference) {
            $component = Component::where('reference', $reference)->first();
            if ($component) {
                $componentId = $component->id;
            }
        }

        return [
            'name' => 'required|string|max:255',
            'reference' => ['required', 'string', Rule::unique('components', 'reference')->ignore($componentId)],
            'price' => 'required|numeric|min:0',
            'stock' => 'integer|min:0',
            'type' => ['required', Rule::enum(ComponentType::class)],
            'resistance_value' => 'required_if:type,resistor|nullable|string',
            'power_rating' => 'required_if:type,resistor|nullable|string',
            'capacitance_value' => 'required_if:type,capacitor|nullable|string',
            'voltage_rating' => 'required_if:type,capacitor|nullable|string',
            'clock_speed' => 'required_if:type,microcontroller|nullable|string',
            'architecture' => 'required_if:type,microcontroller|nullable|string',
            'gpio_count' => 'required_if:type,microcontroller|nullable|integer|min:0',
        ];
    }
}
