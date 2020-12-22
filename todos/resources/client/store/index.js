import { createStore } from 'vuex'
const axios = require('axios')

// Create a new store instance.
const store = createStore({
  state () {
    return {
        todos: [],
        errors: []
    }
  },

  mutations: {

    fetchTodos(state){
      axios.get('/api/todos')
           .then((resp)=>{
              store.commit('setTodos', resp.data)
           }).catch((error) => {
              error.response.data.errors.td_content.forEach((error)=>{
                state.errors.push(error)
              })
           }).then(()=>{
              setTimeout(()=>{
                store.commit('resetErrors')
              }, 4000)
          })
    },

    addNewTodo (state, payload) {
      axios.post('/api/todos', {td_content: payload.td_content})
           .then((resp)=>{
             state.todos.push(resp.data)
           }).catch((error)=>{
            error.response.data.errors.td_content.forEach((error)=>{
              state.errors.push(error)
            })
            // state.errors.push(error.response.data.errors.td_content[0])
            /*
             console.log(error.response.data);
             console.log(error.response.status);
             console.log(error.response.headers);
             */
           }).then(()=>{
             setTimeout(()=>{
               store.commit('resetErrors')
             }, 4000)
           })
    },

    todoToggleStatus(state, payload){

      axios.patch('/api/todos/' + payload)
           .then((resp)=>{
            //  store.commit('fetchTodos')
           }).catch((error) => {
                error.response.data.errors.td_content.forEach((error)=>{
                  state.errors.push(error)
                })
            }).then(()=>{
                setTimeout(()=>{
                  store.commit('resetErrors')
                }, 4000)
            })

      state.todos.forEach((elm)=>{
        elm.id === payload ? elm.td_status = !elm.td_status : '';
      })
    },

    deleteTodo(state, payload){
      if(confirm('Are you sure ?')){

        axios.delete('/api/todos/' + payload)
        .then((resp)=>{
         //  store.commit('fetchTodos')
        }).catch((error) => {
             error.response.data.errors.td_content.forEach((error)=>{
               state.errors.push(error)
             })
         }).then(()=>{
             setTimeout(()=>{
               store.commit('resetErrors')
             }, 4000)
         })

        state.todos.forEach((elm, index)=>{
          elm.id === payload ? state.todos.splice(index, 1) : ''
        })
      }
    },

    updateTodo(state, payload){

      axios.patch('/api/todos/' + payload.id, { td_content: payload.td_content })
      .then((resp)=>{
        //  store.commit('fetchTodos')
        console.log(resp.data)
      }).catch((error) => {
           error.response.data.errors.td_content.forEach((error)=>{
             state.errors.push(error)
           })
       }).then(()=>{
           setTimeout(()=>{
             store.commit('resetErrors')
           }, 4000)
       })

      state.todos.forEach((elm) => {
        if(elm.id === payload.id){
          elm.td_content = payload.td_content
        }
      })
    },


    resetErrors(state){
      state.errors = []
    },
    
    setTodos(state, todosArray){
      state.todos = todosArray
    }

  }

})

export default store;