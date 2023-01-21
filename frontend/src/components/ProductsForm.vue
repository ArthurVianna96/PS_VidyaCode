<script setup>
  import { ref, reactive, computed } from 'vue';
  import { useVuelidate } from '@vuelidate/core';
  import { helpers, minLength, required } from '@vuelidate/validators';

  import InputComponent from './InputComponent.vue';
  import { registerProduct } from '../services/api';

  const name = ref('');
  const description = ref('');
  const version = ref('');

  const state = reactive({
    name,
    description,
    version,
  });

  const REQUIRED_FIELD_MSG='Campo Obrigatório';

  const rules = computed(() => ({
    name: { 
      required: helpers.withMessage(REQUIRED_FIELD_MSG, required), 
      minLength: helpers.withMessage('O campo deve ter pelo menos 3 caracteres', minLength(3)),
    },
    description: { 
      required: helpers.withMessage(REQUIRED_FIELD_MSG, required), 
      minLength: helpers.withMessage('O campo deve ter pelo menos 20 caracteres', minLength(20)),
    },
    version: { 
      required: helpers.withMessage(REQUIRED_FIELD_MSG, required), 
      format: helpers.withMessage('O campo deve possuir o formato de X.X.X', helpers.regex(/^\d+\.\d+\.\d+$/)),
    }
  }));

  const v$ = useVuelidate(rules, state);

  const fields = [
    { name: 'name', placeholder: 'Nome do Produto', type: 'text', model: name },
    { name: 'description', placeholder: 'Descrição', type: 'text', model: description },
    { name: 'version', placeholder: 'Versão', type: 'text', model: version },
  ];

  const onSubmit = async () => {
    v$.value.$validate();
    if(v$.value.$error) {
      return;
    }
    const input = {
      name: name.value,
      description: description.value,
      version: version.value,
    }
    const { status, message } = await registerProduct(input);
    alert(`status: ${status}\n ${message}`);
    v$.value.$reset();
    name.value='';
    description.value='';
    version.value='';
  }
  
</script>

<template>
  <div class="form-container">
    <div v-for="field in fields" class="input-group">
      <InputComponent 
        :name="field.name"
        :type="field.type"
        :placeholder="field.placeholder"
        v-model:value="field.model.value"
      />
      <div class="error" v-if="v$[field.name].$invalid && v$[field.name].$dirty">
        <p v-for="error in v$[field.name].$errors">
          {{ error.$message }}
        </p>
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