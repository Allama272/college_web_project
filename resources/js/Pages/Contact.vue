<script setup>
import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>
<template>
    <body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center pt-20 space-y-8">


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

        <div class="flex flex-col md:flex-row gap-8 max-w-5xl w-full m-10">
            <div class="bg-white shadow-lg rounded-lg w-full md:w-1/2 p-8 space-y-6">
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">Contact Us</h1>
                    <p class="text-gray-600 mb-6">We'd love to hear from you. Reach out through one of the methods
                        below.</p>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center space-x-4 bg-blue-50 p-4 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-800">Email</h3>
                            <a href="mailto:contact@example.com"
                                class="text-blue-600 hover:underline">contact@example.com</a>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4 bg-green-50 p-4 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-800">Phone</h3>
                            <a href="tel:+1234567890" class="text-green-600 hover:underline">+20 1234 5678</a>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4 bg-purple-50 p-4 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-800">Address</h3>
                            <p class="text-purple-600">123 Business Street, City, State 12345</p>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-500 mt-6">We typically respond within 1-2 business days.</p>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg w-full md:w-1/2 p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Team</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Abdullah Walied Allama</td>
                                <td class="px-6 py-4">22011538</td>
                            </tr>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Khaled Hamada Abdelazim</td>
                                <td class="px-6 py-4">22011551</td>
                            </tr>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Marawan Khaled</td>
                                <td class="px-6 py-4">22011560</td>
                            </tr>
                            <tr class="bg-white hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Amir</td>
                                <td class="px-6 py-4">22015985</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="w-full max-w-4xl">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Company Overview</h2>
                <div class="flex justify-center">
                    <video controls class="rounded-lg max-w-full h-auto">
                        <source :src="'/Corporate_Video.mp4'" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
        <footer class="bg-white/50 backdrop-blur-md shadow-md w-full m-0 p-0">
            <div class="container mx-auto py-6 px-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-700 text-sm"> 2024 Twotter All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <span class="text-gray-700 hover:text-gray-900">Privacy Policy</span>
                    <span class="text-gray-700 hover:text-gray-900">Terms of Service</span>
                    <a :href="route('contact')" class="text-gray-700 hover:text-gray-900">Contact Us</a>
                </div>
            </div>
        </footer>
    </body>
</template>
<style scoped>
body {
    background-image: linear-gradient(to top, rgba(168, 237, 234, 0.5) 0%, rgba(254, 214, 227, 0.5) 100%);
}
</style>
