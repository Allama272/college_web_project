<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import Chirp from '@/Components/Chirp.vue';
import { computed } from 'vue';
import FollowButton from '@/Components/FollowButton.vue';

const props = defineProps(['pub_user', 'user_chirps', 'user_followers', 'isFollowing', 'user_following']);
const form = useForm({
    message: '',
});

const photo = props.pub_user.photo ? props.pub_user.photo : "https://cdn.pixabay.com/photo/2018/11/13/21/43/avatar-3814049_1280.png";
const isButtonDisabled = computed(() => form.message.trim().length === 0 || form.message.trim().length > 255);
function titleCase(text) {
    return text.toLowerCase().replace(/(?:^|\s)\w/g, (match) => match.toUpperCase());
}
</script>

<template>
    <div>

        <Head title="Dashboard" />

        <AuthenticatedLayout>
            <section class="relative pt-40 pb-24">
                <img src="https://pagedone.io/asset/uploads/1705471739.png" alt="cover-image"
                    class="w-full absolute top-0 left-0 z-0 h-60 object-cover">
                <div class="w-full max-w-7xl mx-auto px-6 md:px-8">
                    <div class="flex items-center justify-center sm:justify-start relative z-10 mb-5">
                        <img :src="photo" alt="user-avatar-image"
                            class="border-4 size-32 border-solid border-white rounded-full object-cover">
                    </div>
                    <div class="flex flex-col sm:flex-row max-sm:gap-5 items-center justify-between mb-5">
                        <div class="block">
                            <h3 class="font-manrope font-bold text-4xl text-gray-900 mb-1">{{ titleCase(pub_user.name)
                                }}</h3>
                        </div>

                    </div>
                    <div class="flex flex-col lg:flex-row max-lg:gap-5 items-center justify-between py-0.5">
                        <div class="flex items-center gap-4">
                            <follow-button v-if="pub_user.id != $page.props.auth.user.id" :user-id="pub_user.id"
                                :initial-is-following="isFollowing" :initial-followers-count="user_followers" />
                            <span v-if="pub_user.id === $page.props.auth.user.id" class="py-3.5 px-5 rounded-full bg-indigo-100 text-indigo-600 font-semibold text-base leading-7 shadow-sm shadow-transparent transition-all duration-500
                         hover:bg-indigo-200">{{ user_followers }} Followers
                            </span>
                            <span  class="py-3.5 px-5 rounded-full bg-violet-100 text-indigo-600 font-semibold text-base leading-7 shadow-sm shadow-transparent transition-all duration-500
                         hover:bg-violet-200">Following {{ user_following }}
                            </span>
                        </div>

                    </div>
                </div>
            </section>



            <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">


                <form v-if="pub_user.id === $page.props.auth.user.id"
                    @submit.prevent="form.post(route('chirps.store'), { onSuccess: () => form.reset() })">
                    <textarea v-model="form.message" placeholder="What's on your mind?"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                    <InputError :message="form.errors.message" class="mt-2" />
                    <PrimaryButton class="mt-4" :is-button-disabled="isButtonDisabled">Post</PrimaryButton>
                </form>

                <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    <Chirp v-for="chirp in user_chirps" :key="chirp.id" :chirp="chirp" />
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>
