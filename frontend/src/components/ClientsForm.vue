<script setup>
  import { ref, reactive, computed, watchEffect } from 'vue';
  import { useVuelidate } from '@vuelidate/core';
  import * as validators from '@vuelidate/validators';

  import InputComponent from './InputComponent.vue';
  import getZipCodeInfo from '../services/viaCEPApi';
  import { registerClient } from '../services/api';
  // import getRegisterNumberInfo from '../services/cnpjApi';

  const company = ref('');
  const fictionalName = ref('');
  const registerNumber = ref('');
  const zipCode = ref('');
  const address = ref('');
  const number = ref('');
  const district = ref('');
  const city = ref('');
  const state = ref('');
  const email = ref('');
  const phone = ref('');

  const formFields = reactive({
    company,
    fictionalName,
    registerNumber,
    zipCode,
    address,
    number,
    district,
    city,
    state,
    email,
    phone,
  });

  const REQUIRED_FIELD_MSG='Campo Obrigatório';

  const rules = computed(() => ({
    company: { required: validators.helpers.withMessage(REQUIRED_FIELD_MSG, validators.required) },
    fictionalName: { required: validators.helpers.withMessage(REQUIRED_FIELD_MSG, validators.required) },
    registerNumber: { 
      required: validators.helpers.withMessage(REQUIRED_FIELD_MSG, validators.required), 
      format: validators.helpers.withMessage('O campo deve ser composto de 14 digitos', validators.helpers.regex(/^\d{14}$/))
    },
    zipCode: { 
      required: validators.helpers.withMessage(REQUIRED_FIELD_MSG, validators.required), 
      format: validators.helpers.withMessage('O campo deve ser composto de 8 digitos', validators.helpers.regex(/^\d{5}-\d{3}$/)),
    },
    address: { required: validators.helpers.withMessage(REQUIRED_FIELD_MSG, validators.required) },
    number: { required: validators.helpers.withMessage(REQUIRED_FIELD_MSG, validators.required) },
    district: { required: validators.helpers.withMessage(REQUIRED_FIELD_MSG, validators.required) },
    city: { required: validators.helpers.withMessage(REQUIRED_FIELD_MSG, validators.required) },
    state: { required: validators.helpers.withMessage(REQUIRED_FIELD_MSG, validators.required) },
    email: { 
      required: validators.helpers.withMessage(REQUIRED_FIELD_MSG, validators.required), 
      email: validators.helpers.withMessage('O campo deve ser um email válido', validators.email),
    },
    phone: { required: validators.helpers.withMessage(REQUIRED_FIELD_MSG, validators.required) },
  }))

  const v$ = useVuelidate(rules, formFields);

  const fields = [
    { name: 'company', placeholder: 'Razão Social', type: 'text', model: company },
    { name: 'fictionalName', placeholder: 'Nome Fantasia', type: 'text', model: fictionalName },
    { name: 'registerNumber', placeholder: 'CNPJ', type: 'text', model: registerNumber },
    { name: 'zipCode', placeholder: 'CEP', type: 'text', model: zipCode },
    { name: 'address', placeholder: 'Endereço', type: 'text', model: address },
    { name: 'district', placeholder: 'Bairro', type: 'text', model: district },
    { name: 'number', placeholder: 'Número', type: 'text', model: number },
    { name: 'city', placeholder: 'Cidade', type: 'text', model: city },
    { name: 'state', placeholder: 'UF', type: 'text', model: state },
    { name: 'email', placeholder: 'E-mail', type: 'email', model: email },
    { name: 'phone', placeholder: 'Telefone', type: 'text', model: phone },
  ];

  watchEffect(async () => {
    if (!zipCode.value || zipCode.value.length !== 8) return;
    const data = await getZipCodeInfo(zipCode.value);
    if (data.erro) return;
    address.value = data.logradouro;
    district.value = data.bairro;
    zipCode.value = data.cep;
    city.value = data.localidade;
    state.value = data.uf;
  });

  const onSubmit = async () => {
    v$.value.$validate();
    if (v$.value.$error) {
      return;
    }
    const input = {
      company: company.value,
      fictionalName: fictionalName.value,
      registerNumber: registerNumber.value,
      zipCode: zipCode.value,
      address: address.value,
      number: number.value,
      district: district.value,
      city: city.value,
      state: state.value,
      email: email.value,
      phone: phone.value,
    }
    const { status, message } = await registerClient(input);
    alert(`status: ${status}\n ${message}`);
  }

  // watchEffect(async () => {
  //   if (!registerNumber.value || registerNumber.value.length !== 14) return;
  //   const data = await getRegisterNumberInfo(registerNumber.value);
  //   console.log(data);
  // })

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
      <div class="error" v-if="v$[field.name]?.$invalid && v$[field.name].$dirty">
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