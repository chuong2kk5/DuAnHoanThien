
<script setup>
defineProps({
 todo:{
  type: Object,
  required: true
 },

 method:{
  toggleComplete(){
    this.$emit('toggle-complete', this.todo.id);
  },
  deleteTodo(){
    this.$emit('delete-todo', this.todo.id);
  }
 }
 
})
</script>

<template>
 <div class="todo-item">
   <input type="checkbox" v-model="todo.completed" @change="$emit('toggle-complete', todo.id)" />
   
  </div>

</template>

<style scoped>

</style>
