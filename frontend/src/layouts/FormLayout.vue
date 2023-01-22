<script setup>
  defineProps({
    title: String,
  });

</script>

<template>
  <form>
    <h1>{{ title }}</h1>
    <hr />
    <slot></slot>
  </form>
</template>

<style scoped>
  form {
    background-color: #252631;
    padding: 2rem 1rem 1rem;
    border-radius: 8px;
    color: #ffffff;
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }
</style>