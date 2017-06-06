<template>
  <div id="app">
    <h1>My Todos {{countTodo}}</h1>
    <todos v-bind:todos="todos"></todos>
    <todo-form v-bind:todos="todos"></todo-form>
  </div>
</template>

<script>
import Todos from './Todos'
import TodoForm from './TodoForm'

export default {
  name: 'todoApp',
  components: {Todos, TodoForm},
  data() {
    return {
      todos: []
    }
  },
  mounted() {
      this.axios.get('http://127.0.0.1:8000/api/todo').then(response => {
        this.todos = response.data
        console.log(response.data)
      }
    )
  },
  computed: {
    countTodo: function () {
      return this.todos.length
    }
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
