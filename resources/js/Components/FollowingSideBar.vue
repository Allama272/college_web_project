<script setup>
import { ref, computed } from 'vue';

const searchQuery = ref('');
const props= defineProps(['followed_users'])
const followingUsers = props.followed_users;
const filteredUsers = computed(() => {
  return followingUsers.filter(user =>
    user.name.toLowerCase().includes(searchQuery.value.toLowerCase())  );
});


</script>

<template>
  <div class="bg-white shadow-lg rounded-xl p-4 w-2/5 md:w-1/4 max-h-screen flex flex-col ">
    <div class="flex items-center mb-4">
      <h2 class="text-xl font-bold text-gray-800 flex-grow">Following</h2>
      <span class="text-gray-500 text-sm">{{ filteredUsers.length }} users</span>
    </div>

    <div class="relative mb-4">
      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </div>
      <input
        v-model="searchQuery"
        type="text"
        placeholder="Search users..."
        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all"
      />
    </div>

    <div class="flex-grow overflow-y-auto space-y-3 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
      <a
        v-for="user in filteredUsers"
        :key="user.id"
        :href="route('user_profile', user.id)"
        class="bock flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group"
      >
        <div  class="relative mr-3">
          <img v-if="user.photo"
            :src="user.photo"
            :alt="user.name"
            class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-sm"
          />
          <img v-else
            src="https://cdn.pixabay.com/photo/2018/11/13/21/43/avatar-3814049_1280.png"
            :alt="user.name"
            class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-sm"
          />


        </div>
        <div class="flex-grow">
          <div class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">
            {{ user.name }}
          </div>
        </div>
        <span class="text-gray-400 hover:text-blue-500 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </span>
    </a>
    </div>

  </div>
</template>

<style scoped>
/* Custom scrollbar for webkit browsers */
.scrollbar-thin::-webkit-scrollbar {
  width: 6px;
}
.scrollbar-thin::-webkit-scrollbar-thumb {
  @apply bg-gray-300 rounded-full;
}
.scrollbar-thin::-webkit-scrollbar-track {
  @apply bg-gray-100;
}
</style>
