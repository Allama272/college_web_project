<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import FollowingSideBar from '@/Components/FollowingSideBar.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import Chirp from '@/Components/Chirp.vue';
import { computed } from 'vue';

const props = defineProps(['chirps', 'followingUsers']);
console.log(props.followingUsers)
const form = useForm({
    message: '',
});
// const followingUsers = [
//   {
//     id: 1,
//     name: 'Emma Johnson',
//     username: '@emma_dev',
//     avatar: '/api/placeholder/50/50?text=EJ',
//     status: 'Online'
//   }];
const isButtonDisabled = computed(() =>
    form.message.trim().length === 0 || form.message.trim().length > 255
);
</script>

<template>

    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="flex overflow-hidden pt-10">
            <div class="flex-1 flex justify-center p-4 overflow-y-auto scrollbar-hide">
                <div class="w-full max-w-xl mx-auto p-4 sm:p-6 lg:p-8">
                    <form @submit.prevent="form.post(route('chirps.store'), { onSuccess: () => form.reset() })">
                        <textarea v-model="form.message" placeholder="What's on your mind?"
                            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            rows="4"></textarea>
                        <InputError :message="form.errors.message" class="mt-2" />
                        <PrimaryButton class="mt-4" :is-button-disabled="isButtonDisabled">Post</PrimaryButton>
                    </form>

                    <div class="mt-6 space-y-4">
                        <div class="bg-white shadow-sm rounded-lg divide-y">
                            <Chirp v-for="chirp in chirps" :key="chirp.id" :chirp="chirp" />
                        </div>
                    </div>
                </div>
            </div>

            <following-side-bar class="pt-10" :followed_users="followingUsers"></following-side-bar>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.overflow-y-auto {
    max-height: 100vh;
    overflow-y: auto;
}

.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

.scrollbar-hide {
    -ms-overflow-style: none;
    /* IE and Edge */
    scrollbar-width: none;
    /* Firefox */
}
</style>
