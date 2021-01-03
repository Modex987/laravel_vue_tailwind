import { createStore } from 'vuex'

let store = createStore({
    state () {
        return {
          navIsOpened: false,
          zIndex: 1,
        }
      },

      mutations: {
        toggleNav(state){
            state.navIsOpened = !state.navIsOpened
        },

        incrementZindex(state){
            state.zIndex++
        },
    }
})

export default store