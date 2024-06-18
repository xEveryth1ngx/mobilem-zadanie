<script setup>

import { defineProps } from 'vue';
import {config} from "../../config.js";

const props = defineProps({
  advertisement: Object,
});
</script>

<template>
  <div>
    <h3>{{ props.advertisement?.title }}</h3>
    <div v-if="props.advertisement?.files">
      <a
          v-for="(file, index) in props.advertisement.files"
          :href="`${config.backendUrl}/image/${file.name}`"
          target="_blank"
          download
      >
        Image {{ index + 1 }}
      </a>
    </div>
    <p>
      {{ props.advertisement?.description }}
    </p>
    <div id="buy-button">{{ props.advertisement?.price }} USD</div>
  </div>
</template>

<style scoped>
</style>