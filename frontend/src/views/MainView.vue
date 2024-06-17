<script setup>

import {ref} from "vue";
import Advertisement from "../components/Advertisements/Advertisement.vue";

const advertisements = ref(null);

const initialize = async () => {
  const response = await fetch("http://localhost:8080/api/index", {
    method: "GET",
  });

  advertisements.value = await response.json();
  console.log(advertisements.value);
};

initialize();

</script>

<template>
    <div v-for="advertisement in advertisements">
      <RouterLink :to="`/advertisement/${advertisement.id}`">
        <Advertisement :advertisement="advertisement" />
      </RouterLink>
    </div>
</template>

<style scoped>
  a {
    all: unset;
  }
</style>