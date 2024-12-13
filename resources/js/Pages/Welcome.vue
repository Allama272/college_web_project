<script setup>
import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>

    <Head title="Welcome" />

    <div class="background-container fixed inset-0 z-[-1]">
        <div class="blob absolute inset-0"></div>
    </div>
    <div class="content min-h-screen">
        <div class="relative isolate">
            <nav v-if="$page.props.auth.user" class="fixed top-0 w-full bg-white/50 backdrop-blur-md shadow-md z-50">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('user_profile', $page.props.auth.user.id)"
                                    class="text-2xl font-semibold">
                                Twotter
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink :href="route('user_profile', $page.props.auth.user.id)"
                                    :active="route().current('user_profile', $page.props.auth.user.id)">
                                    Profile
                                </NavLink>
                                <NavLink :href="route('chirps.index')" :active="route().current('chirps.index')">
                                    Posts
                                </NavLink>
                                <NavLink :href="route('contact')" :active="route().current('contact')">
                                    Contact
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:ms-6 sm:flex sm:items-center">
                            <!-- Settings Dropdown -->
                            <div class="relative ms-3">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center rounded-md border border-transparent  px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')">
                                            Edit Profile
                                        </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button @click="
                                showingNavigationDropdown =
                                !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex':
                                            !showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex':
                                            showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }" class="sm:hidden">
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('chirps.index')" :active="route().current('chirps.index')">
                            Chirps
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="border-t border-gray-200 pb-1 pt-4">
                        <div class="px-4">
                            <div class="text-base font-medium text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <nav v-else class="fixed top-0 left-0 w-full bg-white/50 backdrop-blur-md shadow-md z-50">
                <div class="container mx-auto flex justify-between items-center py-4 px-6">
                    <a :href="route('Home')" class="text-2xl font-bold text-gray-800">Twotter</a>
                    <div>
                        <a :href="route('login')" class="text-gray-700 hover:text-gray-900 px-4 py-2">Login</a>
                        <a :href="route('register')"
                            class="text-gray-700 hover:text-gray-900 px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-200">Register</a>
                    </div>
                </div>
            </nav>
            <div class="mx-auto max-w-2xl pt-32 sm:pt-48 lg:pt-56">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                </div>
                <header class="text-center">
                    <h1 class="text-balance text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">
                        The New and Modern Social Media
                    </h1>
                    <p class="mt-8 text-pretty text-lg font-medium text-gray-500 sm:text-xl/8">
                        Connect and reach the masses with the new and modern social media Network
                    </p>

                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <Link :href="route('register')"
                            class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Register</Link>
                        <a :href="route('login')" class="text-sm/6 font-semibold text-gray-900">Log In <span
                                aria-hidden="true">→</span></a>
                    </div>
                    <div class="relative w-full max-w-2xl mx-auto pb-[56.25%] mt-8 mb-28">
                        <iframe class="absolute top-0 left-0 w-full h-full"
                            src="https://www.youtube.com/embed/FPhg_ZjrPtU?si=8sQ0jSetaj4MCDrh"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                        </iframe>
                    </div>
                </header>
            </div>

            <footer class="bg-white/50 backdrop-blur-md shadow-md">
                <div class="container mx-auto py-6 px-6 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-700 text-sm"> 2024 Twotter All rights reserved.</p>
                    <div class="flex space-x-4 mt-4 md:mt-0">
                        <span class="text-gray-700 hover:text-gray-900">Privacy Policy</span>
                        <span class="text-gray-700 hover:text-gray-900">Terms of Service</span>
                        <a :href="route('contact')" class="text-gray-700 hover:text-gray-900">Contact Us</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>
<style scoped>
.background-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    pointer-events: none;
}

.blob {
    position: absolute;
    width: 700px;
    height: 700px;
    background: linear-gradient(180deg, rgba(137, 47, 255, 0.42) 31.77%, #6392de 100%);
    mix-blend-mode: color-dodge;
    animation: move 25s infinite alternate;
    transition: 1s cubic-bezier(0.07, 0.8, 0.16, 1);
    pointer-events: auto;
    /* Allow hover interactions */
}

.blob:hover {
    width: 620px;
    height: 620px;
    filter: blur(30px);
    box-shadow:
        inset 0 0 0 5px rgba(255, 255, 255, 0.6),
        inset 100px 100px 0 0px #fa709a,
        inset 200px 200px 0 0px #784ba8,
        inset 300px 300px 0 0px #2b86c5;
}

@keyframes move {
    from {
        transform: translate(-100px, -50px) rotate(-90deg);
        border-radius: 24% 76% 35% 65% / 27% 36% 64% 73%;
    }

    to {
        transform: translate(500px, 100px) rotate(-10deg);
        border-radius: 76% 24% 33% 67% / 68% 55% 45% 32%;
    }
}

.content {
    position: relative;
    z-index: 1;
    background-image: linear-gradient(to top, rgba(168, 237, 234, 0.5) 0%, rgba(254, 214, 227, 0.5) 100%);
}
</style>
