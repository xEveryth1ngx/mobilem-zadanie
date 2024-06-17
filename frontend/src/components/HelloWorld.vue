<script setup>
import { ref } from 'vue'

defineProps({
  msg: String,
})

const count = ref(0)
const sendRequest = async () => {
  try {
    const response = await fetch('http://127.0.0.1:8080/api/test', {
      method: 'GET',
    });

    if (!response.ok) {
      console.error('Network response was not ok');
    }
    else {
      console.log('Network response was ok');
    }

    const data = await response.json();
    console.log(data);
  } catch (error) {
    console.error('There has been a problem with your fetch operation:', error);
  }
}

console.log('koniec')
</script>

<template>
  <h1>{{ msg }}</h1>

  <div class="card">
    <button type="button" @click="sendRequest">count is {{ count }}</button>
    <p>
      Edit
      <code>components/HelloWorld.vue</code> to test HMR
    </p>
  </div>

  <p>
    Check out
    <a href="https://vuejs.org/guide/quick-start.html#local" target="_blank"
      >create-vue</a
    >, the official Vue + Vite starter
  </p>
  <p>
    Install
    <a href="https://github.com/vuejs/language-tools" target="_blank">Volar</a>
    in your IDE for a better DX
  </p>
  <p class="read-the-docs">Click on the Vite and Vue logos to learn more</p>
<!--  <router-link to="/">Home</router-link>-->
</template>

<style scoped>
.read-the-docs {
  color: #888;
}
</style>
