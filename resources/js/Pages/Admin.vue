<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const props = defineProps(['chirps']);

const deleteChirp = (id) => {
    if (confirm('Are you sure you want to delete this post?')) {
        router.delete(route('admin_delete', id));
    }
};
</script>

<template>

    <Head title="Admin Dashboard" />
    <AuthenticatedLayout>
        <div class="min-h-screen bg-gray-100">
            <div class="py-12">
                <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h1 class="text-5xl font-bold my-6">Admin Pannel</h1>
                            <h2 class="text-2xl font-semibold mb-6">Manage Posts</h2>
                            <!-- Posts List -->
                            <div class="space-y-4">
                                <div v-for="chirp in chirps" :key="chirp.id"
                                    class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50">
                                    <div>
                                        <p class="font-medium">{{ chirp.message }}</p>
                                        <p class="text-sm text-gray-500">Posted by: {{ chirp.user.name }}</p>
                                    </div>
                                    <button @click="deleteChirp(chirp.id)"
                                        class="px-3 py-1 text-sm text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md">
                                        Delete
                                    </button>
                                </div>

                                <!-- Empty State -->
                                <div v-if="chirps.length === 0" class="text-center py-8 text-gray-500">
                                    No posts found.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.overflow-y-auto {
    max-height: calc(100vh - 64px);
    overflow-y: auto;
}
</style>
