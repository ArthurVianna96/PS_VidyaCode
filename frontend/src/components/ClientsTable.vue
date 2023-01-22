<script setup>
  import { Pencil, TrashCan, Update } from 'mdue';

  import { deleteClient } from '../services/api';

  defineProps({
    data: Array,
  });

  const emits = defineEmits(['showModal', 'onDelete', 'updateExpirationDates']);

  const remove = async (id) => {
    const { status, message } = await deleteClient(id);
    alert(`status: ${status}\n ${message}`);
    if (status !== 200) return;
    emits('onDelete');
  }
</script>

<template>
  <table>
    <tr>
      <th></th>
      <th>Razão Social</th>
      <th>Nome Fantasia</th>
      <th>CNPJ</th>
      <th>CEP</th>
      <th>Endereço</th>
      <th>Cidade</th>
      <th>Contato</th>
      <th>Ações</th>
    </tr>
    <tr v-for="(client, idx) in data">
      <td>{{ idx+1 }}</td>
      <td>{{ client.company }}</td>
      <td>{{ client.fictional_name }}</td>
      <td>{{ client.register_number }}</td>
      <td>{{ client.zip_code }}</td>
      <td>
        <p>{{ client.address }}</p>
        <p>{{ client.district }}</p>
        <p>{{ client.number }}</p>
      </td>
      <td>
        {{ client.city }}/{{ client.state }}
      </td>
      <td>
        <p>{{ client.email }}</p>
        /
        <p>{{ client.phone }}</p>
      </td>
      <td class="actions">
        <button @click="$emit('showModal', client)"><Pencil /></button>
        <button @click="$emit('updateExpirationDates', client.id)"><Update /></button>
        <button @click="remove(client.id)"><TrashCan /></button>
      </td>
    </tr>
  </table>
</template>

<style scoped>
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
  td {
    font-size: 1rem;
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
    flex-wrap: wrap;
  }
  .actions button {
    font-size: 20px;
    background-color: rgba(128, 128, 128, 0.178);
    border: 1px solid rgb(20, 131, 10);
    border-radius: 3px;
    padding: 0.3rem;
  }
  .actions button:first-of-type {
    border: 1px solid rgb(233, 171, 78);
  }
  .actions button:last-of-type {
    border: 1px solid rgb(224, 59, 59);  }
  .actions button:hover {
    cursor: pointer;
    opacity: 0.8;
  }

</style>