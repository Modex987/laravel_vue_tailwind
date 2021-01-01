<template>
    <div class="sm:flex">
        <Nav />
        <div class="p-4">
            <h1>Hello from vue</h1>
        </div>
    </div>
</template>

<script>
import Nav from './components/Nav'
import { useStore } from 'vuex'

export default {
    components: {
        Nav
    },

    data(){
        return {
            store: useStore()
        }
    },

}
</script>

<style>
</style>