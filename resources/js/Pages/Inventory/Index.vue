<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps<{
    components: Array<{
        name: string;
        reference: string;
        price: number;
        stock: number;
        type: string;
        specifications: Record<string, any>;
    }>;
}>();

const deleteComponent = (reference: string) => {
    if (confirm('Are you sure you want to delete this component?')) {
        router.delete(route('inventory.destroy', reference));
    }
};

const formatSpecs = (specs: Record<string, any>) => {
    return Object.entries(specs)
        .map(([key, value]) => `${key.replace('_', ' ')}: ${value}`)
        .join(', ');
};
</script>

<template>
    <Head title="Inventory" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Component Inventory
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mb-6">
                    <Link
                        :href="route('inventory.create')"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
                    >
                        Add Component
                    </Link>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reference</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specifications</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="component in components" :key="component.reference">
                                        <td class="px-6 py-4 whitespace-nowrap font-mono text-sm">{{ component.reference }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ component.name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">{{ component.type }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ component.price }} €</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ component.stock }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ formatSpecs(component.specifications) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <Link 
                                                :href="route('inventory.edit', component.reference)"
                                                class="text-indigo-600 hover:text-indigo-900 mr-4"
                                            >
                                                Edit
                                            </Link>
                                            <button 
                                                @click="deleteComponent(component.reference)"
                                                class="text-red-600 hover:text-red-900"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="components.length === 0">
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                            No components found.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
