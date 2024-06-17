<script setup>

import Routes from "../components/Routes.vue";
</script>

<template>
  <div>
    <Routes />
  </div>
  <slot></slot>
</template>

<style scoped>
  div {
    width: 100%;
  }
</style>