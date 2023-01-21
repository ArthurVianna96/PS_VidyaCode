<script setup>
  import { ref, watchEffect } from 'vue';

  import HeaderComponent from '../components/HeaderComponent.vue';
  import ProductsTable from '../components/ProductsTable.vue';
  import PurchasesTable from '../components/PurchasesTable.vue';
  import ClientsTable from '../components/ClientsTable.vue';
  import SelectComponent from '../components/SelectComponent.vue';
  import { fetchClients, fetchProducts, fetchPurchases } from '../services/api';

  const options = [
    { name: 'Cliente', id: 'client' },
    { name: 'Produto', id: 'product' },
    { name: 'Compras', id: 'purchase' }
  ]

  const data = ref([]);
  const typeOfFetch = ref('');

  watchEffect(async () => {
    if (!typeOfFetch.value) return;
    switch(typeOfFetch.value) {
      case 'client':
        data.value = await fetchClients();
        break;
      case 'product':
        data.value = await fetchProducts();
        break;
      case 'purchase':
        data.value = await fetchPurchases();
        break;
      default:
        break;
    }
  });

</script>

<template>
  <HeaderComponent />
  <div class="container">
    <section>
      <SelectComponent 
        name="Tipo de consulta"
        placeholder="Selecione uma opção"
        v-model:value="typeOfFetch"
        :options="options"
        class="select"
      />
      <PurchasesTable v-if="typeOfFetch === 'purchase'" :data="data"/>
      <ProductsTable v-if="typeOfFetch === 'product'" :data="data" />
      <ClientsTable v-if="typeOfFetch === 'client'" :data="data" />
    </section>
  </div>
</template>

<style scoped>
  .container {
    padding: 0.5rem;
    padding-top: 5rem;
    display: flex;
    justify-content: center;
  }
  section {
    display: flex;
    align-items: flex-start;
    flex-direction: column;
    gap: 1rem;
    width: 80%;
  }
  .select {
    width: fit-content;
  }
</style>