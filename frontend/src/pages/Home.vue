<script setup>
  import HeaderVue from '../components/HeaderVue.vue';
  import HelloWorld from '../components/HelloWorld.vue';
</script>

<template>
  <HeaderVue />
  <div class="container">
    <HelloWorld />
    <p>Teste</p>
  </div>
</template>

<style scoped>
  .container {
    padding: 0.5rem;
  }
</style>