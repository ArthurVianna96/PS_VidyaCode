<script setup>
  import { ref, watchEffect } from 'vue';
  import { AccountSearch } from 'mdue';

  import HeaderComponent from '../components/HeaderComponent.vue';
  import ProductsTable from '../components/ProductsTable.vue';
  import PurchasesTable from '../components/PurchasesTable.vue';
  import ClientsTable from '../components/ClientsTable.vue';
  import SelectComponent from '../components/SelectComponent.vue';
  import { fetchClients, fetchProducts, fetchPurchases } from '../services/api';
  import EditModal from '../components/EditModal.vue';
  import FormLayout from '../layouts/FormLayout.vue';
  import ProductClientForm from '../components/ProductClientForm.vue';
  import ProductsForm from '../components/ProductsForm.vue';
  import ClientsForm from '../components/ClientsForm.vue';

  const options = [
    { name: 'Cliente', id: 'client' },
    { name: 'Produto', id: 'product' },
    { name: 'Compras', id: 'purchase' }
  ]

  const data = ref([]);
  const typeOfFetch = ref('');
  const showModal = ref(false);
  const editData = ref({});

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

  const showEditModal = (payload) => {
    showModal.value = true;
    editData.value = payload;
  }

  const closeEditModal = () => showModal.value = false;

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
      <PurchasesTable v-if="typeOfFetch === 'purchase'" :data="data" @showModal="showEditModal" />
      <ProductsTable v-else-if="typeOfFetch === 'product'" :data="data" @showModal="showEditModal" />
      <ClientsTable v-else-if="typeOfFetch === 'client'" :data="data" @showModal="showEditModal" />
      <table v-else>
        <tr>
          <th>.</th>
        </tr>
        <tr>
          <td>
            <div class="no-data">
              <AccountSearch />
              <p>Selecione um tipo de consulta</p>
            </div>
          </td>
        </tr>
      </table>
    </section>
  </div>
  <EditModal v-if="showModal" @closeModal="closeEditModal">
    <FormLayout v-if="typeOfFetch === 'purchase'" title="Compra">
      <ProductClientForm :edit-data="editData" />
    </FormLayout>
    <FormLayout title="Produto" v-if="typeOfFetch === 'product'">
      <ProductsForm :edit-data="editData" />
    </FormLayout>
    <FormLayout title="Cliente" v-if="typeOfFetch === 'client'">
      <ClientsForm :edit-data="editData" />
    </FormLayout>
  </EditModal>
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
    min-width: 80%;
  }
  .select {
    width: fit-content;
  }
  table {
    border-collapse: collapse;
    width: 100%;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: #25263141 5px 0px 20px 1px;
  }
  th, td {
    padding: 0.8rem 1rem;
    text-align: center;
  }
  th {
    padding: 1.5rem;
    color: transparent;
  }
  tr:nth-child(odd) {
    background-color: #e7e7e7;
  }
  tr:first-of-type {
    background-color: #252631;
    color: #ffffff;
  }
  .actions {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
  }
  .actions button {
    font-size: 20px;
    background-color: rgba(128, 128, 128, 0.178);
    border: 1px solid rgb(224, 59, 59);
    border-radius: 3px;
    padding: 0.3rem;
  }
  .actions button:first-of-type {
    border: 1px solid rgb(233, 171, 78);
  }
  .actions button:hover {
    cursor: pointer;
    opacity: 0.8;
  }
  .no-data {
    font-size: 6rem;
    color: #838282;
  }
  .no-data > p {
    font-size: 24px;
  }
</style>