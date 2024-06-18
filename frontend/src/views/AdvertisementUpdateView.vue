<script setup>

import AdvertisementForm from "../components/Advertisements/AdvertisementForm.vue";
import {config} from "../config.js";
import {onMounted, ref} from "vue";
import {useRoute} from "vue-router";

const route = useRoute();
const advertisement = ref({
  title: "",
  description: "",
  price: "",
});

const fetchData = async () => {
  const url = `${config.backendUrl}/show/${route.params.id}`;
  const response = await fetch(url, {
    method: "GET"
  });

  advertisement.value = await response.json();
}

onMounted(async () => {
  await fetchData();
});
</script>

<template>
  <div class="advertisement-container">
    <AdvertisementForm
        :path="'update'"
        :title="advertisement.title"
        :description="advertisement.description"
        :price="advertisement.price"
    />
  </div>
</template>

<style scoped>

</style>