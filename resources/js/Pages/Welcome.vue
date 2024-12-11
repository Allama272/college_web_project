<script setup>
import { Head, Link, router } from '@inertiajs/vue3';

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


    <div class="background-container">
        <div class="blob"></div>
    </div>
    <div class="content">

        <div class="relative isolate px-6 pt-14 lg:px-8">
            <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">

                </div>
                <div class="text-center">
                    <h1 class="text-balance text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">
                        The New and Modern Social Media
                    </h1>
                    <p class="mt-8 text-pretty text-lg font-medium text-gray-500 sm:text-xl/8">
                        Connect and reach the masses with the new and moren social media Network
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <Link :href="route('register')"
                            class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Register</Link>
                        <a :href="route('login')" class="text-sm/6 font-semibold text-gray-900">Log In <span
                                aria-hidden="true">→</span></a>
                    </div>
                </div>
            </div>
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
