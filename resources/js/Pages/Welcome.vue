<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();
</script>

<template>
    <Head title="Welcome" />
    <div class="min-h-screen bg-[#483c37] text-gray-100 flex flex-col items-center justify-center selection:bg-blue-500 selection:text-white">

        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
            <header class="flex items-center justify-center gap-2 py-10">
                <h1 class="text-3xl font-bold text-white">Eff'Innov Inventaire Test</h1>
            </header>

            <main class="mt-6 flex flex-col items-center justify-center text-center">
                <div class="p-10 bg-white rounded-lg shadow-lg border border-gray-200 max-w-2xl w-full">
                    <h2 class="text-2xl font-bold mb-4 text-[#94c24b]">Bienvenue sur votre gestionnaire de stock</h2>
                    <p class="mb-8 text-lg text-gray-600 dark:text-gray-400">
                        Gérez vos composants électroniques simplement et efficacement.
                    </p>

                    <div v-if="$page.props.auth.user" class="space-y-4">
                         <p class="text-[#94c24b] font-medium">Vous êtes connecté.</p>
                         <Link
                            :href="route('inventory.index')"
                            class="inline-block px-6 py-3 bg-[#94c24b] text-white font-semibold rounded-lg hover:bg-[#83a842] transition"
                        >
                            Gérer mon inventaire
                        </Link>
                    </div>

                    <div v-else class="space-y-4">
                        <p class="text-gray-400">Veuillez vous connecter pour accéder à l'application.</p>
                        <div class="flex gap-4 justify-center">
                            <Link
                                :href="route('login')"
                                class="px-6 py-2 bg-[#94c24b] text-white rounded hover:bg-[#83a842] transition"
                            >
                                Connexion
                            </Link>
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="px-6 py-2 border border-[#94c24b] rounded hover:bg-[#83a842] hover:text-white transition text-[#94c24b]"
                            >
                                Inscription
                            </Link>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>
