<template>
    <button @click="toggleNav" ref="draggableContainer" @mousedown="dragMouseDown" class="m-2 absolute p-2 bg-green-600 border-none rounded focus:outline-none flex items-center justify-between">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
    </button>

    <transition name="slide-fade">
        <header v-if="navIsOpened" class="bg-blue-600 p-4 sm:text-center flex items-start justify-between sm:block sm:min-h-screen">
            <h1 class="sm:px-4 text-white font-black text-4xl sm:mb-8">todos</h1>
            <ul>
                <li class="mb-3 text-blue-900 hover:text-black hover:underline">
                    <router-link :to="{name: 'Todos'}">todos list</router-link>
                </li>                
                <li class="mb-3 text-blue-900 hover:text-black hover:underline">
                    <router-link :to="{name: 'Profile'}">profile</router-link>
                </li>                
                <li class="mb-3 text-blue-900 hover:text-black hover:underline">
                    <form action="/logout" method="POST">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input type="submit" value="log out" class="bg-transparent cursor-pointer">
                    </form>
                </li>
            </ul>
        </header>
    </transition>
</template>



<script>

import { ref } from 'vue'
import { useStore } from 'vuex'
import Mixin from '../mixins'

export default {
    name: 'Nav',

    mixins: [Mixin],

    computed: {
        
        navIsOpened(){
            return this.store.state.navIsOpened
            // return this.$store.state.navIsOpened
        }
    },

    methods: {

        dragMouseDown: function (event) {
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

            if(this.$refs.draggableContainer.offsetTop < window.innerHeight && this.$refs.draggableContainer.offsetLeft < window.innerWidth){
                // set the element's new position:
                this.$refs.draggableContainer.style.top = (this.$refs.draggableContainer.offsetTop - 8 - this.positions.movementY) + 'px'
                this.$refs.draggableContainer.style.left = (this.$refs.draggableContainer.offsetLeft - 8 - this.positions.movementX) + 'px'
            }
        },

        closeDragElement () {
            document.onmouseup = null
            document.onmousemove = null
        }
    },

    data(){
        return {
            positions: {
                clientX: undefined,
                clientY: undefined,
                movementX: 0,
                movementY: 0
            }
        }
    },

    setup(){
        let store = useStore()

        let toggleNav = () => {
            store.commit('toggleNav')
        }

        return{
            toggleNav,
            store
        }
    },
    
    mounted(){
    }

}
</script>

<style scoped>

button{
    z-index: 100000001;
    right: 0;
}

/* .slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(-20px);
  opacity: 0;
} */

@media (min-width: 640px) {

    .slide-fade-enter-active {
    transition: all 0.7s ease-out;
    }

    .slide-fade-leave-active {
    transition: all 0.7s cubic-bezier(1, 0.5, 0.8, 1);
    }

    .slide-fade-enter-from,
    .slide-fade-leave-to {
    transform: translateX(-120px);
    /* opacity: 0; */
    }
}

@media (max-width: 640px) {

    .slide-fade-enter-active {
    transition: all 0.7s ease-out;
    }

    .slide-fade-leave-active {
    transition: all 0.7s cubic-bezier(1, 0.5, 0.8, 1);
    }

    .slide-fade-enter-from,
    .slide-fade-leave-to {
    transform: translateY(-120px);
    /* opacity: 0; */
    }
}
</style>