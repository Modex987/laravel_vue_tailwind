<template>
    <div class="sm:flex">
        <Nav />
        <div>
            <router-view />
        </div>
    </div>
</template>

<script>
import Nav from './components/Nav'
import { useStore } from 'vuex'

export default {
    components: {
        Nav,
    },

    methods: {
        
    },

    data(){
        return {
            store: useStore()
        }
    },

    mounted(){
        this.store.commit('fetchContact')
        this.store.commit('fetchUser')
    }

}
</script>

<style>
#app{
    max-width: 100vw;
    overflow: hidden;
}

</style>