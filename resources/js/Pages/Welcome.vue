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
    <div class="min-h-screen bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 flex flex-col items-center justify-center selection:bg-blue-500 selection:text-white">

        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
            <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                <div class="flex lg:col-start-2 lg:justify-center">
                    <!-- Logo or Icon could go here -->
                    <h1 class="text-3xl font-bold text-blue-600">EffInnov Inventory</h1>
                </div>
                <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('inventory.index')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-blue-500 dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Access Inventory
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-blue-500 dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Log in
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-blue-500 dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Register
                        </Link>
                    </template>
                </nav>
            </header>

            <main class="mt-6 flex flex-col items-center justify-center text-center">
                <div class="p-10 bg-white dark:bg-zinc-900 rounded-lg shadow-lg border border-gray-200 dark:border-zinc-800 max-w-2xl w-full">
                    <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Bienvenue sur votre gestionnaire de stock</h2>
                    <p class="mb-8 text-lg text-gray-600 dark:text-gray-400">
                        Gérez vos composants électroniques simplement et efficacement.
                    </p>

                    <div v-if="$page.props.auth.user" class="space-y-4">
                         <p class="text-green-600 font-medium">Vous êtes connecté.</p>
                         <Link
                            :href="route('inventory.index')"
                            class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition"
                        >
                            Gérer mon inventaire
                        </Link>
                    </div>

                    <div v-else class="space-y-4">
                        <p class="text-gray-600 dark:text-gray-400">Veuillez vous connecter pour accéder à l'application.</p>
                        <div class="flex gap-4 justify-center">
                            <Link
                                :href="route('login')"
                                class="px-6 py-2 bg-gray-800 text-white rounded hover:bg-gray-700 transition dark:bg-white dark:text-black dark:hover:bg-gray-200"
                            >
                                Connexion
                            </Link>
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="px-6 py-2 border border-gray-300 rounded hover:bg-gray-50 transition dark:border-zinc-700 dark:hover:bg-zinc-800"
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
