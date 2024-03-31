<template>
    AAA
    {{ count }}

    <button @click="count++">
        Add
    </button>
</template>

<script setup>
    import { ref } from 'vue'

    const count = ref(0)
</script>