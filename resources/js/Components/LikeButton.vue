<template>
    <button @click="toggleLike" :disabled="loading" class="flex items-center space-x-1">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6"
        :class="post.liked_by_user ? 'text-red-500' : 'text-gray-400'"
        fill="currentColor"
        viewBox="0 0 24 24"
        stroke="none"
      >
        <path
          d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
        />
      </svg>
      <span>{{ post.likes_count }}</span>
    </button>
  </template>

<script>
import axios from 'axios';

export default {
    props: {
        post: {
            type: Object,
            required: true,
        }
    },
    methods: {
        async toggleLike() {
            try {
                const response = await axios.post(`/chirps/${this.post.id}/like`);
                this.post.liked_by_user = response.data.liked;
                this.post.likes_count = response.data.likes_count;
            } catch (error) {
                console.error('Error toggling like:', error);
            }
        },
    },
};
</script>

<style scoped>
button {
    cursor: pointer;
    font-size: 1.2em;
    background: none;
    border: none;
    outline: none;
}
</style>
