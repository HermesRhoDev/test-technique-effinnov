<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps<{
    component: Record<string, any>;
    types: string[];
}>();

const form = useForm({
    name: props.component.name,
    reference: props.component.reference,
    price: props.component.price,
    stock: props.component.stock,
    type: props.component.type,
    // Resistor
    resistance_value: props.component.resistance_value || '',
    power_rating: props.component.power_rating || '',
    // Capacitor
    capacitance_value: props.component.capacitance_value || '',
    voltage_rating: props.component.voltage_rating || '',
    // Microcontroller
    clock_speed: props.component.clock_speed || '',
    architecture: props.component.architecture || '',
    gpio_count: props.component.gpio_count || 0,
});

const submit = () => {
    form.put(route('inventory.update', props.component.reference));
};
</script>

<template>
    <Head title="Edit Component" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Component
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-6">
                    <Link :href="route('inventory.index')" class="text-blue-600 hover:text-blue-800">
                        &larr; Back to Inventory
                    </Link>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                        <!-- Common Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Type</label>
                                <select
                                    v-model="form.type"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    required
                                >
                                    <option v-for="t in types" :key="t" :value="t" class="capitalize">{{ t }}</option>
                                </select>
                                <div v-if="form.errors.type" class="text-red-600 text-sm mt-1">{{ form.errors.type }}</div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Reference</label>
                                <input
                                    type="text"
                                    v-model="form.reference"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    required
                                >
                                <div v-if="form.errors.reference" class="text-red-600 text-sm mt-1">{{ form.errors.reference }}</div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <input
                                    type="text"
                                    v-model="form.name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    required
                                >
                                <div v-if="form.errors.name" class="text-red-600 text-sm mt-1">{{ form.errors.name }}</div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Price (€)</label>
                                <input
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    v-model="form.price"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    required
                                >
                                <div v-if="form.errors.price" class="text-red-600 text-sm mt-1">{{ form.errors.price }}</div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Stock</label>
                                <input
                                    type="number"
                                    min="0"
                                    v-model="form.stock"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    required
                                >
                                <div v-if="form.errors.stock" class="text-red-600 text-sm mt-1">{{ form.errors.stock }}</div>
                            </div>
                        </div>

                        <!-- Dynamic Fields -->
                        <div v-if="form.type === 'resistor'" class="bg-gray-50 p-4 rounded-lg mb-6">
                            <h3 class="font-semibold mb-4 text-gray-700">Resistor Specifications</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Resistance Value</label>
                                    <input type="text" v-model="form.resistance_value" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <div v-if="form.errors.resistance_value" class="text-red-600 text-sm mt-1">{{ form.errors.resistance_value }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Power Rating</label>
                                    <input type="text" v-model="form.power_rating" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <div v-if="form.errors.power_rating" class="text-red-600 text-sm mt-1">{{ form.errors.power_rating }}</div>
                                </div>
                            </div>
                        </div>

                        <div v-if="form.type === 'capacitor'" class="bg-gray-50 p-4 rounded-lg mb-6">
                            <h3 class="font-semibold mb-4 text-gray-700">Capacitor Specifications</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Capacitance Value</label>
                                    <input type="text" v-model="form.capacitance_value" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <div v-if="form.errors.capacitance_value" class="text-red-600 text-sm mt-1">{{ form.errors.capacitance_value }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Voltage Rating</label>
                                    <input type="text" v-model="form.voltage_rating" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <div v-if="form.errors.voltage_rating" class="text-red-600 text-sm mt-1">{{ form.errors.voltage_rating }}</div>
                                </div>
                            </div>
                        </div>

                        <div v-if="form.type === 'microcontroller'" class="bg-gray-50 p-4 rounded-lg mb-6">
                            <h3 class="font-semibold mb-4 text-gray-700">Microcontroller Specifications</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Clock Speed</label>
                                    <input type="text" v-model="form.clock_speed" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <div v-if="form.errors.clock_speed" class="text-red-600 text-sm mt-1">{{ form.errors.clock_speed }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Architecture</label>
                                    <input type="text" v-model="form.architecture" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <div v-if="form.errors.architecture" class="text-red-600 text-sm mt-1">{{ form.errors.architecture }}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">GPIO Count</label>
                                    <input type="number" min="0" v-model="form.gpio_count" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <div v-if="form.errors.gpio_count" class="text-red-600 text-sm mt-1">{{ form.errors.gpio_count }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition"
                                :disabled="form.processing"
                            >
                                {{ form.processing ? 'Saving...' : 'Update Component' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </AuthenticatedLayout>
</template>
