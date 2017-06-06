import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import TodoApp from '../components/TodoApp.vue'
import Todo from '../components/Todo.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {path: '/', name: 'TodoApp', component: TodoApp},
    {path: '/todo/:id', name: 'Todo', component: Todo}
  ]
})
