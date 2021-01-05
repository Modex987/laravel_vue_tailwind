<template>
    <Alert :msg="alert.msg" v-if="alert.visible" />
    <div id="todo" :class="{'bg-opacity-25': todo.status}" class="m-1 flex flex-col  border-2 absolute rounded bg-blue-900 text-white" ref="draggableContainer">
        <div class="flex flex-wrap justify-between p-1 cursor-move" @mousedown="dragMouseDown">
            <div>
                <svg class="text-transparent hover:text-white w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                <span v-if="!isEditMode">{{todo.title}}</span>
            </div>
            <div>
                <button @click="toggleEditMode" v-if="!todo.status" class="hover:text-black cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </button>
                <button @click="deleteTodo" class="hover:text-black ml-2 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
                <button @click="toggleStatus" v-if="todo.id" class="hover:text-black ml-2 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </button>
            </div>
        </div>
        <div :class="{'bg-opacity-25': todo.status}" class="border-t-2 border-b-2 p-1 bg-gray-300 text-gray-900 flex-grow flex justify-items-stretch">
            <p :class="{'text-opacity-25': todo.status}" v-if="!isEditMode" class="break-words">
                {{todo.body}}
            </p>
            <div class="flex justify-items-stretch flex-col">
                <input type="text" v-if="isEditMode" v-model="todo.title" class="rounded mb-1">
                <textarea v-if="isEditMode" v-model="todo.body" class="flex-grow w-full">
                </textarea>
            </div>
        </div>
        <div class="justify-between p-1">
            <small class="block" v-if="todo.updated_at && !isEditMode" >last updated: {{ todo.updated_at }}</small>
            <small v-if="todo.date_limit && !isEditMode">limit time: {{ todo.date_limit }}</small>
            <input type="date" v-if="isEditMode" v-model="todo.date_limit" class="text-black rounded">
        </div>
    </div>
</template>



<script>
import Mixin from '../mixins'
import Alert from '../components/Alert'
import { useStore } from 'vuex'

export default {
    name: 'Todo',

    components: {
        Alert
    },

    mixins: [Mixin],

    props: {
        todo: Object
    },

    data: function () {
        return {
            // todo: {
            //     body: null,
            //     title: 'null',
            //     status: false,
            //     updated_at: null,
            //     time_left: null
            // },

            store: useStore(),

            isEditMode: false,

            positions: {
                clientX: undefined,
                clientY: undefined,
                movementX: 0,
                movementY: 0
            }
        }
    },

    methods: {
        toggleEditMode(){
            if(this.isEditMode){
                if(this.todo.title && this.todo.body){
                    this.store.commit(this.todo.id ? 'updateTodo' : 'storeTodo', this.todo)
                    this.isEditMode = !this.isEditMode
                }else{
                    this.alrt('You can\'t save todo with empty fields')
                }
            }else{
                this.isEditMode = !this.isEditMode
            }
        },        
        
        toggleStatus(){
            this.isEditMode = false
            // this.todo.status = !this.todo.status
            this.store.commit('updateTodoStatus', this.todo)
        },        
        
        deleteTodo(){
            this.store.commit('deleteTodo', this.todo)
        },

        // *************** 

        dragMouseDown: function (event) {

            this.$refs.draggableContainer.style.zIndex = this.$store.state.zIndex
            this.$store.commit('incrementZindex')

            event.preventDefault()
            // get the mouse cursor position at startup:
            this.positions.clientX = event.clientX
            this.positions.clientY = event.clientY
            document.onmousemove = this.elementDrag
            document.onmouseup = this.closeDragElement
        },

        elementDrag: function (event) {
            event.preventDefault()
            this.positions.movementX = this.positions.clientX - event.clientX
            this.positions.movementY = this.positions.clientY - event.clientY
            this.positions.clientX = event.clientX
            this.positions.clientY = event.clientY
            // set the element's new position:
            this.$refs.draggableContainer.style.top = (this.$refs.draggableContainer.offsetTop - 4 - this.positions.movementY) + 'px'
            this.$refs.draggableContainer.style.left = (this.$refs.draggableContainer.offsetLeft - 4 - this.positions.movementX) + 'px'
        },

        closeDragElement () {
            // this.$refs.draggableContainer.style.zIndex = 'unset'
            document.onmouseup = null
            document.onmousemove = null
        }
    }

}
</script>

<style scoped>

#todo{
    min-height: 250px;
    min-width: 200px;
    max-width: 300px;
}

#todo p{

    /* overflow-wrap: break-word;
    word-wrap: break-word;
    hyphens: auto; */

    /* word-wrap: break-word;
    white-space: -moz-pre-wrap;
    white-space: pre-wrap; */
}

</style>