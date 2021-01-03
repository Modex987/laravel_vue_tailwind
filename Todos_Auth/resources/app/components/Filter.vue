<template>
    <div id="filter" ref="draggableContainer" class="flex items-center flex-col text-white absolute top-1 right-1/12">
        <div class="bg-blue-700 px-2 rounded-t-lg cursor-move" @mousedown="dragMouseDown">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
        </div>
        <div id="filter" class="bg-blue-700 flex justify-evenly">
            <button @click="toggleSelectedClass" class="focus:outline-none border-none hover:opacity-75 p-1 px-3 mx-3 selected">All</button>
            <button @click="toggleSelectedClass" class="focus:outline-none border-none hover:opacity-75 p-1 px-3 mx-3">Actif</button>
            <button @click="toggleSelectedClass" class="focus:outline-none border-none hover:opacity-75 p-1 px-3 mx-3">Completed</button>
            <button @click="toggleSelectedClass" class="focus:outline-none border-none hover:opacity-75 p-1 px-3 mx-3">Deleted</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Filter',

    data: function () {
        return {
            positions: {
                clientX: undefined,
                clientY: undefined,
                movementX: 0,
                movementY: 0
            }
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
            // set the element's new position:
            this.$refs.draggableContainer.style.top = (this.$refs.draggableContainer.offsetTop - this.positions.movementY) + 'px'
            this.$refs.draggableContainer.style.left = (this.$refs.draggableContainer.offsetLeft - this.positions.movementX) + 'px'
        },

        closeDragElement () {
            document.onmouseup = null
            document.onmousemove = null
        },

        // ********************************

        toggleSelectedClass: (e) => {
            document.querySelectorAll('div#filter > button').forEach(btn => {
                btn.classList.remove('selected')
            });
            e.target.classList.add('selected')
            
        }
    }

}
</script>

<style scoped>

.selected{
    color: black;
    border-top: 2px solid black;
    border-bottom: 2px solid black;
}

#filter{
    z-index: 100000000;
    width: 400px;
}

</style>