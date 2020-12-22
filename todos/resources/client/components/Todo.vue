<template>
    <div class="flex justify-between items-center bg-white text-gray-800 rounded mb-4 p-2 shadow-2xl">
        <span class="cursor-pointer" @click="todoToggleStatus">
            <svg :class="{'text-transparent': !td_status}" class="w-12 h-12 rounded-full border-gray-400 border-4 hover:border-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </span>
        <input v-if="editMode" type="text" class="mx-4 p-3 outline-none rounded w-96 border-4" v-model="td_content">
        <p v-else class="w-96 text-left mx-4 py-1" v-text="td_content"></p>
        <ul class="flex">
            <li class="mx-2 cursor-pointer" @click="editTodo()"><svg class="w-9 h-9 text-cool-gray-400 hover:text-cool-gray-800 rounded-full" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></li>
            <li class="mx-2 cursor-pointer" @click="deleteTodo()"><svg class="w-9 h-9 text-cool-gray-400 hover:text-cool-gray-800 rounded-full" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'Todo',

    props: {
        id: String,
        td_status: Boolean,
        td_content: String
    },

    data(){
        return {
            editMode: false
        }
    },

    methods: {
        todoToggleStatus(){
            this.$store.commit('todoToggleStatus', this.id)
        },

        deleteTodo(){
            this.$store.commit('deleteTodo', this.id)
        },

        editTodo(){
            if(this.editMode){
                if(this.td_content){
                    this.$store.commit('updateTodo', {
                        id: this.id,
                        td_content: this.td_content
                    })
                }
            }

            this.editMode = !this.editMode
        }
    },

    mounted(){

    }

}
</script>

<style>

</style>