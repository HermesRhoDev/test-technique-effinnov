<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
    links: Array<{
        url: string | null;
        label: string;
        active: boolean;
    }>;
}>();

const translateLabel = (label: string) => {
    return label.replace('Previous', 'Précédent').replace('Next', 'Suivant');
};
</script>

<template>
    <div v-if="links.length > 3" class="flex justify-center mt-6">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, key) in links" :key="key">
                <div
                    v-if="link.url === null"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                    v-html="translateLabel(link.label)"
                />
                <Link
                    v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-gray-100 focus:border-[#94c24c] focus:text-[#94c24c] transition-colors duration-200"
                    :class="{ 'bg-[#94c24c] text-white hover:bg-[#83a842]': link.active, 'bg-white text-gray-700': !link.active }"
                    :href="link.url"
                    v-html="translateLabel(link.label)"
                />
            </template>
        </div>
    </div>
</template>
