<script setup>
  import { ref, reactive, computed, watchEffect } from 'vue';
  import { useVuelidate } from '@vuelidate/core';
  import { required, helpers } from '@vuelidate/validators';

  import InputComponent from './InputComponent.vue';
  import SelectComponent from './SelectComponent.vue';
  import { fetchClients, fetchProducts, registerPurchase, editPurchase } from '../services/api';

  const props = defineProps(['editData']);

  const clients = ref([]);
  const products = ref([]);
  const id = ref(props.editData ? props.editData.id  : '');
  const clientId = ref(props.editData ? props.editData.client_id  : '');
  const productId = ref(props.editData ? props.editData.product_id : '');
  const expirationDate = ref(props.editData ? props.editData.expirationDate.split(' ')[0] : '');

  const state = reactive({
    clientId,
    productId,
    expirationDate,
  });

  const REQUIRED_FIELD_MSG='Campo Obrigatório';

  const rules = computed(() => ({
    clientId: { required: helpers.withMessage(REQUIRED_FIELD_MSG, required) },
    productId: { required: helpers.withMessage(REQUIRED_FIELD_MSG, required) },
    expirationDate: { required: helpers.withMessage(REQUIRED_FIELD_MSG, required) }
  }));

  const v$ = useVuelidate(rules, state);


  watchEffect(async () => {
    const clientsArray = await fetchClients();
    clientsArray.forEach((client) => clients.value.push({ name: client.fictional_name, id: client.id }));
    products.value = await fetchProducts();
  });

  const registerSubmit = async (input) => {
    const { status, message } = await registerPurchase(input);
    alert(`status: ${status}\n ${message}`);
  }

  const editSubmit = async (input) => {
    const { status, message } = await editPurchase(input, id.value);
    alert(`status: ${status}\n ${message}`);
  }
  
  const onSubmit = async () => {
    v$.value.$validate();
    if(v$.value.$error) {
      return;
    }

    const input = {
      clientId: clientId.value,
      productId: productId.value,
      expirationDate: expirationDate.value,
    }
    if (!props.editData) {
      await registerSubmit(input);
    } else {
      await editSubmit(input);
    }
    v$.value.$reset();
  }

</script>

<template>
  <div class="form-container">
    <div class="input-group">
      <SelectComponent 
        name="Cliente"
        placeholder="Selecione um cliente"
        v-model:value="clientId"
        :options="clients"
      />
      <div class="error" v-if="v$.clientId.$invalid && v$.clientId.$dirty">
        {{ v$.clientId.$errors[0].$message }}
      </div>
    </div>
    <div class="input-group">
      <SelectComponent 
        name="Produto"
        placeholder="Selecione um produto"
        v-model:value="productId"
        :options="products"
      />
      <div class="error" v-if="v$.productId.$invalid && v$.productId.$dirty">
        {{ v$.productId.$errors[0].$message }}
      </div>
    </div>
    <div class="input-group">
      <InputComponent
        name="expiration-date"
        placeholder="Data de validade do produto"
        type="date"
        v-model:value="expirationDate"
      />
      <div class="error" v-if="v$.expirationDate.$invalid && v$.expirationDate.$dirty">
        {{ v$.expirationDate.$errors[0].$message }}
      </div>
    </div>
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