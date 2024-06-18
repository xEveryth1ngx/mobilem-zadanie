<script setup>
import {onMounted, ref} from 'vue';
import {config} from "../../config.js";
import {useRoute} from "vue-router";
import {router} from "../../router.js";

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
    type: String,
    required: false,
  }
})

const route = useRoute();

const form = ref(null);
const files = ref(null);
const errors = ref([]);
const values = ref({
  title: props.title,
  description: props.description,
  price: props.price,
});

const validateData = () => {
  if (files.value.files.length > 5) {
    errors.value.push('oopsie, too many files! Max 5 files allowed!');

    return false;
  }

  return true;
};

const handleSubmit = async () => {
  errors.value = [];

  if (!validateData()) {
    return;
  }

  const formDataObject = new FormData(form.value);

  let url = `${config.backendUrl}/create`;
  let requestData = {
    method: 'POST',
    body: formDataObject,
  };

  if (props.path === 'update') {
    url = `${config.backendUrl}/update/${route.params.id}`;
    requestData.headers = {
      "X-HTTP-Method-Override": "PUT",
    };
  }

  try {
    const response = await fetch(url, requestData);

    if (response.ok) {
      await router.push({ path: '/' });
    }
  } catch (e) {
    errors.value.push('oopsie, something went wrong! Error: ' + e);
  }
};

</script>

<template>
  <form @submit.prevent="handleSubmit" ref="form">
    <div>
      <label for="title">Title</label>
      <input
          name="title"
          type="text"
          :value="props.title"
          required
      >
    </div>
    <div>
      <label for="description">Description</label>
      <textarea
          name="description"
          :value="props.description"
          required
      >
        {{ values.description }}
      </textarea>
    </div>
    <div>
      <label for="price">Price</label>
      <input
          name="price"
          type="number"
          :value="props.price"
          required
      >
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
    <div v-for="error in errors">
      {{ error }}
    </div>
    <button type="submit">Submit</button>
  </form>
</template>

<style scoped>
  input {
    margin-bottom: 10px;
  }
</style>