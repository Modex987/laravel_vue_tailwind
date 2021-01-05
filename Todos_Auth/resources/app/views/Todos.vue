<template>
  <div class="flex items-center flex-col">
    <h1 class="text-white font-black text-5xl">todos</h1>
    <hr class="p-1 w-10/12">
    <Filter />
    <div id="todos_container" class="p-2 relative flex">
      <Todo v-for="(todo, index) in store.state.todos" :key="index" :todo="todo"/>
    </div>
    <button @click="addTodo" class="text-blue-700 absolute bottom-4 rounded-full border-2 border-transparent hover:border-blue-700 focus:outline-none">
      <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
    </button>
  </div>
</template>



<script>
import Todo from '../components/Todo'
import Filter from '../components/Filter'
import { useStore } from 'vuex'

export default {
    name: 'Todos',

    components: {
      Todo,
      Filter
    },

    data(){
      return {
        store: useStore()
      }
    },

    methods: {
      addTodo(){
        let todo = {
          uuid: String((new Date).getTime()) + Math.floor(Math.random() * 100),
          title: null,
          body: null,
          status: false,
          date_limit: null,
        }

        this.store.commit('addTodo', todo)
      }
    },

    mounted(){
      this.$store.commit('fetchTodos', 'all')
    }

}
</script>

<style scoped>

#todos_container{
  min-width: 100vw;
}

</style>
