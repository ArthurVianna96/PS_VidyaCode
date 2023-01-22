<script setup>
  defineEmits(['closeModal']);
</script>

<template>
  <div class="modal-overlay">
    <div class="modal">
      <slot></slot>
    </div>
    <div class="close" @click="$emit('closeModal')">
      x
    </div>
  </div>
</template>

<style scoped>
  .modal-overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  display: flex;
  justify-content: center;
  background-color: #dddcdcda;
}

.modal {
  text-align: center;
  background-color: white;
  min-width: 500px;
  height: fit-content;
  margin-top: 10%;
  border-radius: 20px;
}
.close {
  color: #ffffff;
  margin-top: 11%;
  transform: translate(-2rem);
  font-size: 20px;
}
.close:hover {
  cursor: pointer;
  color: #dddcdcda;
}
</style>