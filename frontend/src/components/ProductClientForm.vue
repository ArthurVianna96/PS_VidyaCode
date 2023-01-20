<script setup>
  import { ref, watchEffect } from 'vue';

  import InputComponent from './InputComponent.vue';
  import SelectComponent from './SelectComponent.vue';
  import { fetchClients, fetchProducts, registerPurchase } from '../services/api';

  const clients = ref([]);
  const products = ref([]);
  const clientId = ref('');
  const productId = ref('');
  const expirationDate = ref('');

  watchEffect(async () => {
    const clientsArray = await fetchClients();
    clientsArray.forEach((client) => clients.value.push({ name: client.fictional_name, id: client.id }));
    products.value = await fetchProducts();
  });
  
  const onSubmit = async () => {
    const input = {
      clientId: clientId.value,
      productId: productId.value,
      expirationDate: expirationDate.value,
    }
    const { status, message } = await registerPurchase(input);
    alert(`status: ${status}\n ${message}`);
  }

</script>

<template>
  <div class="form-container">
    <SelectComponent 
      name="Cliente"
      placeholder="Selecione um cliente"
      v-model:value="clientId"
      :options="clients"
    />
    <SelectComponent 
      name="Produto"
      placeholder="Selecione um produto"
      v-model:value="productId"
      :options="products"
    />
    <InputComponent
      name="expiration-date"
      placeholder="Data de validade do produto"
      type="date"
      v-model:value="expirationDate"
    />
  </div>
  <div class="form-actions">
    <button @click.prevent="onSubmit">Salvar</button>
  </div>
</template>

<style scoped>
  .form-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
  }
  .form-actions {
    display: flex;
    justify-content: end;
  }
  button {
    background-color: #40d7e1;
    color: #14171C;
    padding: 0.7rem 1.5rem;
    font-weight: 500;
    font-size: 16px;
    border: none;
    border-radius: 3px;
    transition: all 150ms ease;
  }
  button:hover {
    background-color: #14171C;
    color: #40d7e1;
    opacity: 0.8;
    cursor: pointer;
  }
</style>