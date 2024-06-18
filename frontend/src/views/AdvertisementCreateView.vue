<script setup>

import AdvertisementForm from "../components/Advertisements/AdvertisementForm.vue";
</script>

<template>
  <div class="advertisement-container">
    <AdvertisementForm :path="'create'" />
  </div>
</template>

<style scoped>
  .advertisement-container {
    cursor: unset;
  }
</style>