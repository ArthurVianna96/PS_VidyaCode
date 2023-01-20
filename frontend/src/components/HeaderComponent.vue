<script setup>
import { RouterLink } from 'vue-router';
</script>

<template>
  <header>
    <nav>
      <RouterLink to="/">Home</RouterLink>
      <RouterLink to="/products">Produtos</RouterLink>
      <RouterLink to="/clients">Clientes</RouterLink>
      <RouterLink to="/register">Compra</RouterLink>
    </nav>
  </header>
</template>

<style scoped>
  header {
    background-color: #14171C;
    padding: 1rem;
  }
  nav {
    display: flex;
    gap: 1rem;
    justify-content: start;
    align-items: center;
  }
  a {
    padding: 0.5rem 1rem;
    text-decoration: none;
    color: #FFFFFF;
    border-radius: 3px;
    transition: all 150ms ease;
    font-weight: 700;
  }
  a:hover {
    background-color: #303450;
  }
  .router-link-active {
    background-color: #2b3055;
  }
</style>