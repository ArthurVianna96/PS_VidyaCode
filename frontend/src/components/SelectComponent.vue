<script setup>
  defineProps({
    name: String,
    placeholder: String,
    value: String,
    options: Array,
  });

  const emit = defineEmits(['update:value']);

  const update = (event) => {
    emit('update:value', event.target.value)
  }
</script>

<template>
  <div class="input-group">
    <p>{{ name }}</p>
    <select :value="value" @change="update">
      <option disabled value="">{{ placeholder }}</option>
      <option v-for="option in options" :value="option.id">{{ option.name }}</option>
    </select>
  </div>
</template>

<style scoped>
  .input-group {
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
  }
  select {
    padding: 0.6rem 0.4rem; 
    border-radius: 3px;
    border: 1px solid #ffffff;
    background-color: #14171C;
    font-size: 14px;
    color: #ffffff;
  }
  select:disabled {
    color: #acaaaa;
  }
</style>