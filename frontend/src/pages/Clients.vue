<script setup>
  import { ref, watchEffect } from 'vue';
  
  import HeaderComponent from '../components/HeaderComponent.vue';
  import ClientsForm from '../components/ClientsForm.vue';
  import FormLayout from '../layouts/FormLayout.vue';
  import { fetchClients } from '../services/api';

  const clients = ref([]);

  watchEffect(async () => {
    clients.value = await fetchClients();
  });

</script>

<template>
  <HeaderComponent />
  <div class="container">
    <div class="form">
      <FormLayout title="Cadastro de Clientes">
        <ClientsForm />
      </FormLayout>
    </div>
  </div>
</template>

<style scoped>
  .container {
    padding: 1rem 0.5rem;
    display: flex;
    justify-content: center;
  }

  .form {
    width: 100%;
    max-width: 800px;
  }
</style>