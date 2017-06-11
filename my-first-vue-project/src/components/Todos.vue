<template>
    <ul class="list-group">
        <li class="list-group-item" v-for="(todo, index) in todos" v-bind:class="{'completed': todo.completed }">
            <router-link :to="{ name: 'Todo', params: { id: todo.id }}">{{ todo.content }}</router-link>
            <button class="btn btn-warning btn-xs pull-right" v-on:click="deleteTodo(todo, index)">Delete</button>
            <button class="btn btn-success btn-xs pull-right" v-on:click="completeTodo(todo)" v-bind:class="[ todo.completed ? 'btn-danger' : 'btn-success' ]">
                {{ todo.completed ? 'undo' : 'done' }}
            </button>
        </li>
    </ul>
</template>

<script>
export default {
    props: ['todos'],
    methods: {
        deleteTodo: function (todo, index) {
            this.axios.delete('http://127.0.0.1:8000/api/todo/' + todo.id + '/delete').then(response=>{
                this.todos.splice(index, 1)
                console.log(response.data)
            })
        },
        completeTodo: function (todo) {
            this.axios.patch('http://127.0.0.1:8000/api/todo/' + todo.id + '/complete').then(response=>{
                todo.completed = !todo.completed
                console.log(response.data)
            })
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.completed {
    color: cadetblue;
    text-decoration: line-through;
}
</style>
