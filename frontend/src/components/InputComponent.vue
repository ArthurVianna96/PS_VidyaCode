<script setup>
  defineProps({
    name: String,
    placeholder: String,
    type: String,
    value: String,
  });

  const emit = defineEmits(['update:value']);

  const update = (event) => {
    emit('update:value', event.target.value)
  }
</script>

<template>
  <div class="input-group">
    <label :for="name">{{placeholder}}</label>
    <input 
      :type="type" 
      :name="name"
      :placeholder="placeholder"
      :value="value"
      @input="update"
    >
  </div>
</template>

<style scoped>
  .input-group {
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
  }
  input[type='text'], input[type='email'], input[type='date'], input[type='number'] {
    padding: 0.6rem 0.4rem; 
    border-radius: 3px;
    border: 1px solid #ffffff;
    background-color: #14171C;
    font-size: 14px;
    color: #ffffff;
  }
  input[type='text']:disabled {
    cursor: not-allowed;
    opacity: 0.8;
  }
  input[type='text']::placeholder, input[type='email']::placeholder, input[type='number']::placeholder {
    color: #acaaaa;
  }
</style>