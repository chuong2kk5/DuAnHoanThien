<template>
    <div class="todo-list">
      <h2>Todo List</h2>
      <input v-model="newTodoText" placeholder="Add a new todo" @keyup.enter="addTodo" />
      <button @click="addTodo">Add Todo</button>
  
      <div v-for="todo in todos" :key="todo.id">
        <TodoItem :todo="todo" @toggle-complete="toggleComplete" @delete-todo="deleteTodo" />
      </div>
    </div>
  </template>
  
  <script>
  import TodoItem from './TodoItem.vue';
  
  export default {
    components: { TodoItem },
    data() {
      return {
        newTodoText: '',
        todos: []
      };
    },
    methods: {
      addTodo() {
        if (this.newTodoText.trim()) {
          this.todos.push({
            id: Date.now(),
            text: this.newTodoText,
            completed: false
          });
          this.newTodoText = '';
        }
      },
      toggleComplete(id) {
        const todo = this.todos.find(todo => todo.id === id);
        if (todo) todo.completed = !todo.completed;
      },
      deleteTodo(id) {
        this.todos = this.todos.filter(todo => todo.id !== id);
      }
    }
  };
  </script>
  
  <style scoped>
  .todo-list {
    width: 300px;
    margin: 0 auto;
  }
  </style>