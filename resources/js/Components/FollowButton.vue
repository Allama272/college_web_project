<template>
    <div>
        <button class="py-3.5 px-5 rounded-full  text-white font-semibold text-base leading-7 shadow-sm shadow-transparent transition-all
        duration-500 hover:shadow-gray-100 "
        :class="isFollowing ? 'bg-red-400 hover:bg-red-500':'bg-indigo-500 hover:bg-indigo-600'"
          @click="toggleFollow">
            {{ isFollowing ? 'Unfollow' : 'Follow' }}
        </button>
        <span class="py-3.5 px-5 rounded-full bg-indigo-50 text-indigo-600 font-semibold text-base leading-7 shadow-sm shadow-transparent transition-all duration-500
         hover:bg-indigo-100">{{ followersCount }} Followers
        </span>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        userId: {
            type: Number,
            required: true,
        },
        initialIsFollowing: {
            type: Boolean,
            required: true,
        },
        initialFollowersCount: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            isFollowing: this.initialIsFollowing,
            followersCount: this.initialFollowersCount,
        };
    },
    methods: {
        async toggleFollow() {
            try {
                const response = await axios.post(`/follow/${this.userId}`);

                if (response.data.success) {
                    this.isFollowing = response.data.following;
                    this.followersCount = response.data.followers_count;
                } else if (response.data.error) {
                    alert(response.data.error);
                }
            } catch (error) {
                console.error(error);
                alert('An error occurred. Please try again.');
            }
        },
    },
};
</script>
