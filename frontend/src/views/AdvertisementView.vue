<script setup>

import Advertisement from "../components/Advertisements/Advertisement.vue";
import {useRoute} from "vue-router";
import {onBeforeMount, ref} from "vue";

const route = useRoute();
const advertisement = ref(null);
const fetchData = async () => {
  const url = `http://localhost:8080/api/show/${route.params.id}`;
  const response = await fetch(url, {
    method: "GET"
  });

  advertisement.value = await response.json();
}

const fetchImage = async (path) => {
  const url = `http://localhost:8080/api/image`;
  const response = await fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      advertisementId: path,
    })
  });

  advertisement.value.files.push(await response.json());
}

onBeforeMount(async () => {
  await fetchData();
  for (const file of advertisement.value.files) {
    await fetchImage(file.name);
  }
  console.log(advertisement.value.files);
});
</script>

<template>
  <div>
    <Advertisement :advertisement="advertisement" />
    <button id="buy-button" type="button">Buy</button>
  </div>
</template>

<style scoped>
  #buy-button {
    margin-top: 1rem;
  }
</style>