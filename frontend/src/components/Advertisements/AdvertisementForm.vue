<script setup>
import {ref} from 'vue';
import {config} from "../../config.js";

const props = defineProps({
  path: String,
  title: {
    type: String,
    required: false,
  },
  description: {
    type: String,
    required: false,
  },
  price: {
    type: Number,
    required: false,
  }
})

const form = ref(null);
const files = ref(null);
const values = ref({
  title: props.title,
  description: props.description,
  price: props.price,
});

const handleSubmit = async () => {
  if (files.value.files.length > 5) {
    console.log('oopsie, too many files');
    return;
  }

  const formDataObject = new FormData(form.value);

  const response = await fetch(config.backendUrl + '/' + props.path, {
    method: 'POST',
    body: formDataObject
  });

  if (response.ok) {
    console.log('success');
  } else {
    console.log('error');
  }
};

</script>

<template>
  <form @submit.prevent="handleSubmit" ref="form">
    <div>
      <label for="title">Title</label>
      <input name="title" type="text" :value="values.title" required>
    </div>
    <div>
      <label for="description">Description</label>
      <textarea
          name="description"
          :value="values.description"
          required
      >
        {{ values.description }}
      </textarea>
    </div>
    <div>
      <label for="price">Price</label>
      <input name="price" type="text" :value="values.price" required>
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
  input {
    margin-bottom: 10px;
  }
</style>