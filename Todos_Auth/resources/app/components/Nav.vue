<template>
    <button @click="toggleNav" ref="draggableContainer" @mousedown="dragMouseDown" class="m-2 absolute bg-green-600 p-3 border-none rounded focus:outline-none flex items-center justify-between">
        <span class="bg-white rounded">&nbsp;</span>
        <span class="bg-white mx-2 rounded">&nbsp;</span>
        <span class="bg-white rounded">&nbsp;</span>
    </button>

    <transition name="slide-fade">
        <header v-if="navIsOpened" class="bg-blue-600 p-4 sm:text-center flex items-center justify-between sm:block sm:min-h-screen">
            <h1 class="sm:px-4 font-black text-4xl sm:mb-8">todos</h1>
            <ul>
                <li>Profile</li>
                <li>Log Out</li>
            </ul>
        </header>
    </transition>
</template>

<script>
import { ref } from 'vue'

import { useStore } from 'vuex'

export default {
    name: 'Nav',

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
    transition: all 0.3s ease-out;
    }

    .slide-fade-leave-active {
    transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
    }

    .slide-fade-enter-from,
    .slide-fade-leave-to {
    transform: translateX(-20px);
    opacity: 0;
    }
}

@media (max-width: 640px) {

    .slide-fade-enter-active {
    transition: all 0.3s ease-out;
    }

    .slide-fade-leave-active {
    transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
    }

    .slide-fade-enter-from,
    .slide-fade-leave-to {
    transform: translateY(-20px);
    opacity: 0;
    }
}
</style>