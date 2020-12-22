<template>
  <div>
      <form class="p-4 text-gray-900" @submit.prevent="addTodo">
          <input type="text" class="mr-1 p-3 outline-none rounded w-96 border-4" v-model="todo.td_content">
          <button class="text-gray-300 rounded-r-full px-6 py-3 font-bold border-4 focus:outline-none">Add</button>
      </form>
  </div>
</template>

<script>
export default {
    name: 'TodoInput',

    data(){
        return {
            todo: {
                td_content: null
            }
        }
    },

    methods: {
        addTodo(){
            if(this.todo.td_content){
                this.$store.commit('addNewTodo', this.todo)
                this.todo.td_content = null
            }
        }
    }

}
</script>

<style>

</style>