<script setup>
  import { Pencil, TrashCan } from 'mdue';

  defineProps({
    data: Array,
  });

  defineEmits(['showModal']);
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
      <th>Bairro</th>
      <th>Número</th>
      <th>Cidade</th>
      <th>UF</th>
      <th>E-mail</th>
      <th>Telefone</th>
      <th>Ações</th>
    </tr>
    <tr v-for="(client, idx) in data">
      <td>{{ idx+1 }}</td>
      <td>{{ client.company }}</td>
      <td>{{ client.fictional_name }}</td>
      <td>{{ client.register_number }}</td>
      <td>{{ client.zip_code }}</td>
      <td>{{ client.address }}</td>
      <td>{{ client.district }}</td>
      <td>{{ client.number }}</td>
      <td>{{ client.city }}</td>
      <td>{{ client.state }}</td>
      <td>{{ client.email }}</td>
      <td>{{ client.phone }}</td>
      <td class="actions">
        <button @click="$emit('showModal', client)"><Pencil /></button>
        <button><TrashCan /></button>
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

</style>