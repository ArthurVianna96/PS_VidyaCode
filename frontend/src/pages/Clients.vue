<script setup>
  import { onMounted } from 'vue';

  import HeaderVue from '../components/HeaderVue.vue';
  import { fetchClients } from '../services/api';

  onMounted(async () => {
    const clients = await fetchClients();
    console.log(clients);
  })
</script>

<template>
  <HeaderVue />
  <div class="container">
    
  </div>
</template>

<style scoped>
  .container {
    padding: 0.5rem;
  }
</style>