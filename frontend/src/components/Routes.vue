<script setup>

</script>

<template>
  <nav class="navbar">
    <RouterLink to="/">Home</RouterLink>
    <RouterLink to="/test">Test</RouterLink>
    <RouterLink to="/advertisement">Advertisement</RouterLink>
    <RouterLink to="/advertisement/create">Create advertisement</RouterLink>
  </nav>
</template>

<style scoped>
  .navbar {
    display: flex;
    justify-content: space-around;
    padding: 1rem;
    font-size: 2em;
    gap: 1rem;
  }
</style>