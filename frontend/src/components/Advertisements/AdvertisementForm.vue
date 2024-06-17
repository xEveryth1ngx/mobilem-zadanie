<script setup>
import {ref, watch} from 'vue';

const form = ref(null);
const files = ref(null);

const handleSubmit = async () => {
  if (files.value.files.length > 5) {
    console.log('oopsie, too many files');
    return;
  }

  const formDataObject = new FormData(form.value);

  const response = await fetch('http://localhost:8080/api/create', {
    method: 'POST',
    body: formDataObject
  });

  if (response.ok) {
    console.log('success');
  } else {
    console.log('error');
  }

  const data = await response.json();
};

</script>

<template>
  <form @submit.prevent="handleSubmit" ref="form" class="main-container">
    <div>
      <label for="title">Title</label>
      <input name="title" type="text">
    </div>
    <div>
      <label for="description">Description</label>
      <textarea name="description"></textarea>
    </div>
    <div>
      <label for="price">Price</label>
      <input name="price" type="text">
    </div>
    <div>
      <label for="image">Image</label>
      <input
          ref="files"
          name="files[]"
          type="file"
          accept="image/jpeg,image/png"
          multiple
      >
    </div>
    <button type="submit">Submit</button>
  </form>
</template>

<style scoped>
  .main-container {
    width: 100%;
    max-width: 500px;
    margin: 1rem auto;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }

  .main-container > div {
    margin-bottom: 20px;
    display: flex;
    gap: 6px;
  }

  input {
    margin-bottom: 10px;
  }
</style>