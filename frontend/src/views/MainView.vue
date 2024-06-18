<script setup>

import {ref} from "vue";
import Advertisement from "../components/Advertisements/Advertisement.vue";
import {config} from "../config.js";

const advertisements = ref(null);

const initialize = async () => {
  const response = await fetch(`${config.backendUrl}/index`, {
    method: "GET",
  });

  advertisements.value = await response.json();
};

initialize();

</script>

<template>
    <template v-for="advertisement in advertisements">
      <RouterLink :to="`/advertisement/${advertisement.id}`">
        <div class="advertisement-container">
          <Advertisement :advertisement="advertisement" />
        </div>
      </RouterLink>
    </template>
</template>

<style scoped>
  a {
    all: unset;
  }
</style>