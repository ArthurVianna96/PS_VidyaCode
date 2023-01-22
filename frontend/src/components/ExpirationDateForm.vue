<script setup>
  import { ref, reactive, computed, watchEffect } from 'vue';
  import { useVuelidate } from '@vuelidate/core';
  import { required, helpers } from '@vuelidate/validators';

  import InputComponent from './InputComponent.vue';
  import { updateClientsPurchase } from '../services/api';

  const props = defineProps({
    clientId: Number
  });

  const daysToAdd = ref(30);

  const state = reactive({
    daysToAdd,
  });

  const REQUIRED_FIELD_MSG='Campo Obrigatório';

  const rules = computed(() => ({
    daysToAdd: { required: helpers.withMessage(REQUIRED_FIELD_MSG, required) }
  }));

  const v$ = useVuelidate(rules, state);
  
  const onSubmit = async () => {
    v$.value.$validate();
    if(v$.value.$error) {
      return;
    }

    const input = {
      clientId: props.clientId,
      daysToAdd: daysToAdd.value,
    }
    const { status, message } = await updateClientsPurchase(input);
    alert(`status: ${status}\n ${message}`);
    v$.value.$reset();
  }

</script>

<template>
  <div class="form-container">
    <div class="input-group">
      <InputComponent
        name="expiration-date"
        placeholder="Quantidade de dias a adicionar"
        type="number"
        v-model:value="daysToAdd"
      />
      <div class="error" v-if="v$.daysToAdd.$invalid && v$.daysToAdd.$dirty">
        {{ v$.daysToAdd.$errors[0].$message }}
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
    grid-template-columns: 1fr;
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