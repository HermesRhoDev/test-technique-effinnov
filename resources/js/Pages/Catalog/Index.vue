<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { ref, watch } from 'vue';

const props = defineProps<{
    components: {
        data: Array<{
            name: string;
            reference: string;
            price: number;
            stock: number;
            type: string;
            specifications: Record<string, any>;
            formatted_specs: string;
        }>;
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
    };
    filters: {
        type: string;
    };
    types: string[];
}>();

const selectedType = ref(props.filters.type || '');

watch(selectedType, (value) => {
    router.get(
        route('catalog.index'),
        { type: value },
        {
            preserveState: true,
            replace: true,
        }
    );
});

const translateLabel = (label: string) => {
    return label.replace('Previous', 'Précédent').replace('Next', 'Suivant');
};
</script>

<template>
    <Head title="Catalogue" />

    <PublicLayout>
        <div class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                    <h1 class="text-3xl font-bold text-gray-900">Catalogue Produits</h1>

                    <div class="flex items-center">
                        <label for="type-filter" class="mr-3 text-sm font-medium text-gray-700">Filtrer par type:</label>
                        <select
                            id="type-filter"
                            v-model="selectedType"
                            class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#94c24c] focus:border-[#94c24c] sm:text-sm rounded-md"
                        >
                            <option value="">Tous les types</option>
                            <option v-for="type in types" :key="type" :value="type" class="capitalize">
                                {{ type }}
                            </option>
                        </select>
                    </div>
                </div>

                <div v-if="components.data.length === 0" class="text-center py-12">
                    <p class="text-gray-500 text-lg">Aucun produit trouvé.</p>
                </div>

                <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <div v-for="component in components.data" :key="component.reference" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
                        <div class="p-6 flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 capitalize">
                                    {{ component.type }}
                                </span>
                                <span :class="component.stock > 0 ? 'text-green-600' : 'text-red-600'" class="text-xs font-medium">
                                    {{ component.stock > 0 ? 'En stock' : 'Rupture' }}
                                </span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1 truncate" :title="component.name">{{ component.name }}</h3>
                            <p class="text-sm text-gray-500 mb-4">Réf: {{ component.reference }}</p>

                            <p class="text-sm text-gray-600 line-clamp-3 mb-4">{{ component.formatted_specs }}</p>
                        </div>

                        <div class="p-6 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-xl font-bold text-[#94c24c]">{{ component.price }} €</span>
                            <Link
                                :href="route('catalog.show', component.reference)"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#483c37] hover:bg-[#3b312d] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#483c37]"
                            >
                                Détails
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div v-if="components.links.length > 3" class="mt-8 flex justify-center">
                    <div class="flex flex-wrap -mb-1">
                        <template v-for="(link, key) in components.links" :key="key">
                            <div
                                v-if="link.url === null"
                                class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                                v-html="translateLabel(link.label)"
                            />
                            <Link
                                v-else
                                class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-[#94c24c] focus:text-[#94c24c]"
                                :class="{ 'bg-[#94c24c] text-white': link.active, 'bg-white text-gray-700': !link.active }"
                                :href="link.url"
                                v-html="translateLabel(link.label)"
                            />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
