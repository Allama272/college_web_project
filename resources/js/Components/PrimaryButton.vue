<template>
    <button
      :class="[
        'inline-flex items-center rounded-md border border-transparent px-4 py-2 text-xs font-semibold uppercase tracking-widest transition duration-150 ease-in-out',
        isButtonDisabled ? 'bg-gray-400 text-gray-500 cursor-not-allowed' : 'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900',
      ]"
      :disabled="isButtonDisabled"
    >
      <slot />
    </button>
  </template>

  <script setup>
    defineProps({
    isButtonDisabled: {
        type: Boolean,
        default: false,
    }
    });
  </script>
