<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="min-h-screen bg-gray-50 flex flex-col">
        <nav class="bg-[#483c37] border-b border-[#94c24c]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <Link :href="route('catalog.index')">
                                <ApplicationLogo class="block h-9 w-auto fill-current text-white" />
                            </Link>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <Link
                                :href="route('catalog.index')"
                                :class="[
                                    route().current('catalog.*')
                                        ? 'border-[#94c24c] text-white'
                                        : 'border-transparent text-gray-300 hover:text-white hover:border-gray-300',
                                    'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out'
                                ]"
                            >
                                Catalogue
                            </Link>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <template v-if="$page.props.auth.user">
                            <Link
                                :href="route('dashboard')"
                                class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Dashboard
                            </Link>
                        </template>
                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Connexion
                            </Link>
                            <Link
                                :href="route('register')"
                                class="ms-4 bg-[#94c24b] hover:bg-[#83a842] text-white px-4 py-2 rounded-md text-sm font-medium transition"
                            >
                                Inscription
                            </Link>
                        </template>
                    </div>

                    <div class="-me-2 flex items-center sm:hidden">
                        <button
                            @click="showingNavigationDropdown = !showingNavigationDropdown"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                        >
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path
                                    :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex': !showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex': showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div
                :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                class="sm:hidden"
            >
                <div class="pt-2 pb-3 space-y-1">
                    <Link
                        :href="route('catalog.index')"
                        :class="[
                            route().current('catalog.*')
                                ? 'bg-[#3b312d] border-[#94c24c] text-white'
                                : 'border-transparent text-gray-300 hover:text-white hover:bg-[#3b312d] hover:border-gray-300',
                            'block w-full ps-3 pe-4 py-2 border-l-4 text-base font-medium transition duration-150 ease-in-out'
                        ]"
                    >
                        Catalogue
                    </Link>
                </div>

                <div class="pt-4 pb-1 border-t border-gray-200">
                    <template v-if="$page.props.auth.user">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-200">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-400">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <Link
                                :href="route('dashboard')"
                                class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-300 hover:text-white hover:bg-[#3b312d] transition duration-150 ease-in-out"
                            >
                                Dashboard
                            </Link>
                        </div>
                    </template>
                    <template v-else>
                        <div class="mt-3 space-y-1">
                            <Link
                                :href="route('login')"
                                class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-300 hover:text-white hover:bg-[#3b312d] transition duration-150 ease-in-out"
                            >
                                Connexion
                            </Link>
                            <Link
                                :href="route('register')"
                                class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-300 hover:text-white hover:bg-[#3b312d] transition duration-150 ease-in-out"
                            >
                                Inscription
                            </Link>
                        </div>
                    </template>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow">
            <slot />
        </main>

        <footer class="bg-[#483c37] text-white py-6 mt-auto">
             <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-400">
                &copy; {{ new Date().getFullYear() }} Test Technique Eff'Innov.
            </div>
        </footer>
    </div>
</template>
