<template>
    <div class="todo">
        <div class="loading" v-if="loading">
            Loading...
        </div>
    
        <div v-if="error" class="error">
            {{ error }}
        </div>
    
        <div v-if="todo" class="content">
            <h2>{{ todo.content }}</h2>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            todo: null,
            error: null
        }
    },
    created() {
        // fetch the data when the view is created and the data is
        // already being observed
        this.fetchData()
    },
    watch: {
        // call again the method if the route changes
        '$route': 'fetchData'
    },
    methods: {
        fetchData() {
            this.error = this.todo = null
            this.loading = true
            // replace getPost with your data fetching util / API wrapper
            this.axios.get('http://127.0.0.1:8000/api/todo/' + this.$route.params.id).then(response => {
                console.log(response.data)
                this.todo = response.data
                this.loading = false
            })
        }
    }
}
</script>
