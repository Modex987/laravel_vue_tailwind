import { createStore } from 'vuex'

let store = createStore({
    state () {
        return {
          navIsOpened: false,
        }
      },

      mutations: {
        toggleNav(state){
            state.navIsOpened = !state.navIsOpened
        },
    }
})

export default store