<script setup>
  import HeaderComponent from '../components/HeaderComponent.vue';
  import ProductClientForm from '../components/ProductClientForm.vue';
  import FormLayout from '../layouts/FormLayout.vue';
</script>

<template>
  <HeaderComponent />
  <div class="container">
    <div class="form">
      <FormLayout title="Cadastro de Compra de Produtos">
        <ProductClientForm :edit-data="null"/>
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