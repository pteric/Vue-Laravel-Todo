<template>
    <form v-on:submit.prevent="createTodo">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Add a new todo" v-model="newTodo.content">
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Add Todos</button>
        </div>
    </form>
</template>

<script>
export default {
    props: ['todos'],
    data() {
        return {
            newTodo: { id: null, content: '', completed: false }
        }
    },
    methods: {
        createTodo: function () {
            this.todos.push(this.newTodo);
            this.newTodo = {
                id: null,
                content: '',
                completed: false
            }
        }
    }
}
</script>
