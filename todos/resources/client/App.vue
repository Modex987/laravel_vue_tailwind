<template>
  <div class="text-center">
    <div v-if="errors.length">
      <Error v-for="(error, index) in errors" :message="error" :key="index"/>
    </div>
    <h1 class="font-black text-2xl text-gray-300 mb-6">VueJs & Laravel Todos_app</h1>
    <TodoInput />
    <div>
      <Todo v-for="todo in todos" :key="todo.id" :td_content='todo.td_content' :td_status="todo.td_status" :id="todo.id"/>
    </div>
  </div>
</template>

<script>
import TodoInput from './components/TodoInput'
import Todo from './components/Todo'
import Error from './components/Error'
import { useStore } from 'vuex'
import { computed, onMounted } from 'vue'

export default {
    name: 'App',

    setup(){
      const store = useStore()

      const todos = computed(() => store.state.todos )
      const errors = computed(() => store.state.errors )

      onMounted(()=>{
        store.commit('fetchTodos')
      })

      return {
        todos, errors
      }
    },

    components: {
      TodoInput,
      Todo,
      Error
    },


    data(){
      return {

      }
    },

    methods: {

    },

    mounted(){

    },

    updated(){

    }
}
</script>

<style>

</style>