import { createStore } from 'vuex'

import axios from 'axios'
import cleanTodo from '../utilities'

let store = createStore({
    state () {
        return {
          navIsOpened: false,
          zIndex: 1,
          todos: [],
          contact: {},
          user: {}
        }
      },

      mutations: {
        toggleNav(state){
            state.navIsOpened = !state.navIsOpened
        },

        incrementZindex(state){
            state.zIndex++
        },

        fetchTodos(state, payload){
            axios.get('/todos?type=' + payload)
                 .then((resp) => {
                    state.todos = resp.data
                 }).catch((err)=>{
                    console.log(err)
                 })
        },

        addTodo(state, payload){
            state.todos.push(payload)
        },

        storeTodo(state, payload){
            for (let i = 0; i < state.todos.length; i++) {
                if(state.todos[i].uuid === payload.uuid){
                    axios.post('/todos', cleanTodo(payload))
                    .then((resp)=>{
                        state.todos[i] = resp.data
                    }).catch(()=>{
   
                    })
                }
            }
        },

        updateTodo(state, payload){
            for (let i = 0; i < state.todos.length; i++) {
                if(state.todos[i].id === payload.id){
                    axios.patch('/todos/' + payload.id, cleanTodo(payload))
                    .then((resp)=>{
                        state.todos[i] = resp.data
                    }).catch(()=>{
   
                    })
                }
            }
        },

        updateTodoStatus(state, payload){
            for (let i = 0; i < state.todos.length; i++) {
                if(state.todos[i].id === payload.id){
                    axios.patch('/todos/' + payload.id + '?status=true')
                    .then((resp)=>{
                        state.todos[i] = resp.data
                    }).catch(()=>{

                    })
                }
            }
        },

        deleteTodo(state, payload){
            if(payload.id){
                for (let i = 0; i < state.todos.length; i++) {
                    if(state.todos[i].id === payload.id){
                        axios.delete('/todos/' + payload.id)
                        .then((resp)=>{
                            state.todos.splice(i, 1)
                        }).catch(()=>{
       
                        })
                    }
                }
            } else if(payload.uuid){
                for (let i = 0; i < state.todos.length; i++) {
                    if(state.todos[i].uuid === payload.uuid){
                        state.todos.splice(i, 1)
                        return
                    }
                }
            }
        },

        fetchContact(state){
            axios.get('/contacts')
                .then((resp)=>{
                    state.contact = resp.data
                }).catch(()=>{

                })
        },

        fetchUser(state){
            axios.get('/me')
                .then((resp)=>{
                    state.user = resp.data
                }).catch(()=>{

                })
        },

        chooseCountry(state, payload){
            state.contact.country = payload
        },

        updateContact(state, payload){
            axios.patch('/contacts/' + state.contact.id, payload)
                 .then((resp) => {
                    // state.contact = resp.data
                 }).catch(()=>{

                 })
        },

        updateMail(state){
            axios.post('/mail', state.user)
                 .then((resp) => {

                 }).catch(()=>{

                 })
        },
    }
})

export default store