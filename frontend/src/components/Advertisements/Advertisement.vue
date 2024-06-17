<script setup>

import { defineProps } from 'vue';

const props = defineProps({
  advertisement: Object,
});
</script>

<template>
  <div>
    <h3>{{ props.advertisement?.title }}</h3>
    <img :src="props.advertisement?.image" alt="advertisement image" />
    <p>
      {{ props.advertisement?.description }}
    </p>
    <div id="buy-button">{{ props.advertisement?.price }} USD</div>
  </div>
</template>

<style scoped>
</style>