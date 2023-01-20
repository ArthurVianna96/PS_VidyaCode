<script setup>
  import HeaderComponent from '../components/HeaderComponent.vue';
  import HelloWorld from '../components/HelloWorld.vue';
</script>

<template>
  <HeaderComponent />
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