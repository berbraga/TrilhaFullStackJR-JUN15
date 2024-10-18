<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center rounded-md border border-gray-300 bg-yellow px-4 py-2 text-xs font-semibold uppercase tracking-widest text-yellow-700 shadow-sm transition duration-150 ease-in-out hover:bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 dark:border-yellow-500 dark:bg-yellow-800 dark:text-yellow-300 dark:hover:bg-yellow-700 dark:focus:ring-offset-gray-800"
    >
        <slot />
    </button>
</template>
