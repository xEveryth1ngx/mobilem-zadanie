<script setup>

import Advertisement from "../components/Advertisements/Advertisement.vue";
import {useRoute} from "vue-router";
import {onBeforeMount, ref} from "vue";
import {config} from "../config.js";

const route = useRoute();
const advertisement = ref(null);

const fetchData = async () => {
  const url = `${config.backendUrl}/show/${route.params.id}`;
  const response = await fetch(url, {
    method: "GET"
  });

  advertisement.value = await response.json();
}

onBeforeMount(async () => {
  await fetchData();
});
</script>

<template>
  <div class="advertisement-container">
    <Advertisement :advertisement="advertisement" />
    <button id="buy-button" type="button">Buy</button>
  </div>
</template>

<style scoped>
  #buy-button {
    margin-top: 1rem;
  }

  .advertisement-container {
    cursor: unset;
  }
</style>