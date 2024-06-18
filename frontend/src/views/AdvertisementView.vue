<script setup>

import Advertisement from "../components/Advertisements/Advertisement.vue";
import {useRoute} from "vue-router";
import {onBeforeMount, ref} from "vue";
import {config} from "../config.js";
import {router} from "../router.js";

const route = useRoute();
const advertisement = ref(null);

const fetchData = async () => {
  const url = `${config.backendUrl}/show/${route.params.id}`;
  const response = await fetch(url, {
    method: "GET"
  });

  advertisement.value = await response.json();
}

const removeAdvertisement = async () => {
  const url = `${config.backendUrl}/delete/${route.params.id}`;
  const response = await fetch(url, {
    method: "POST",
    headers: {
      "X-HTTP-Method-Override": "DELETE",
    },
  });

  if (response.ok) {
    router.push({path: '/'});
  }
}

onBeforeMount(async () => {
  await fetchData();
});
</script>

<template>
  <div class="advertisement-container">
    <Advertisement :advertisement="advertisement" />
    <div id="buttons">
      <RouterLink :to="`/advertisement/update/${route.params.id}`">
        <button type="button">Update</button>
      </RouterLink>
      <button @click="removeAdvertisement" type="button">Delete</button>
    </div>
  </div>
</template>

<style scoped>
  .advertisement-container {
    cursor: unset;
  }

  #buttons {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 2rem;
    gap: 5px;
  }
</style>