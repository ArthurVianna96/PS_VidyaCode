import { createRouter, createWebHistory } from 'vue-router';

import Home from '../pages/Home.vue';
import Products from '../pages/Products.vue';
import Clients from '../pages/Clients.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/products', component: Products },
  { path: '/clients', component: Clients },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;