<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';

defineProps<{
    component: {
        name: string;
        reference: string;
        price: number;
        stock: number;
        type: string;
        specifications: Record<string, any>;
        formatted_specs: string;
    };
}>();
</script>

<template>
    <Head :title="component.name" />

    <PublicLayout>
        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-6">
                    <Link :href="route('catalog.index')" class="text-[#94c24c] hover:text-[#83a842] flex items-center font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Retour au catalogue
                    </Link>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="md:flex">
                        <!-- Placeholder Image Section -->
                        <div class="md:w-1/3 bg-gray-200 flex items-center justify-center p-12">
                            <div class="text-center text-gray-400">
                                <svg class="w-24 h-24 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-lg font-medium">Image non disponible</span>
                            </div>
                        </div>

                        <!-- Details Section -->
                        <div class="p-8 md:w-2/3">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800 capitalize mb-2">
                                        {{ component.type }}
                                    </span>
                                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ component.name }}</h1>
                                    <p class="text-gray-500 mb-4">Réf: {{ component.reference }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-3xl font-bold text-[#94c24c]">{{ component.price }} €</p>
                                    <p :class="component.stock > 0 ? 'text-green-600' : 'text-red-600'" class="font-medium mt-1">
                                        {{ component.stock > 0 ? 'En stock (' + component.stock + ')' : 'Rupture de stock' }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-8 border-t border-gray-200 pt-8">
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">Spécifications Techniques</h2>
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                    <div v-for="(value, key) in component.specifications" :key="key" class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500 capitalize">{{ key }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ value }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
