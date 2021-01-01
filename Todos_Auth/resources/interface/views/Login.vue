<template>
  <div class="flex justify-center items-center pt-16">
      <form @submit.prevent="formSubmitted" ref="form" class="bg-white rounded-lg shadow-lg shape" method="POST" action='/login'>
          <div class="bg-green-600 px-8 py-3 rounded-t-lg">
              <h1 class="font-black text-4xl text-gray-400">Login</h1>
          </div>
            <input type="hidden" name="_token" v-bind:value="csrf">
          <div class="p-8">
            <div class="mb-6">
                <label for="email" class="">E-mail</label>
                <input type="email" v-model="formData.email.val" name="email" id="email" :class="{'invalid': !formData.email.is_valid}" class="ring-2 ring-green-300 block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
                <small v-for="(err, index) in formData.email.errors" :key="index" v-text="err" class="min-w-full text-red-600 pl-4"></small>
            </div>
            <div class="mb-6">
                <label for="password" class="">Password</label>
                <input type="password" v-model="formData.password.val" :class="{'invalid': !formData.password.is_valid}" name="password" id="password" class="ring-2 ring-green-300 block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
                <small v-for="(err, index) in formData.password.errors" :key="index" v-text="err" class="min-w-full text-red-600 pl-4"></small>
            </div>
            <div class="mb-6 flex items-cener">
                <input type="checkbox" name="remember" id="remember" class="mr-4 h-5 w-5 text-white checked:bg-green-700 checked:border-transparent">    
                <label for="remember" class="">Remember me</label>
            </div>
            <SubmitBtn value="Login"/>
          </div>
      </form>
  </div>
</template>



<script>
import { ref } from 'vue'
import SubmitBtn from '../components/SubmitBtn'
import Field from '../utilities/validation'
import Mixin from '../mixins'


export default {
    name: 'Login',

    components: {
        SubmitBtn
    },

    mixins: [Mixin],

    methods: {
        formIsValid(){
            this.formData.email.require('email is required')
            this.formData.password.require('password is required').min(8, 'Password can\'t contain less than 8 caracters')

            for(let key in this.formData){
                if(!this.formData[key].is_valid){
                    return false
                }
            }

            return true
        },

        formSubmitted(){
            for(let key in this.formData){
                this.formData[key].reset()
            }

            if(this.formIsValid()){

                this.$refs.form.submit();
            }
        }
    },

    setup(){
        let formData = ref({
            email: new Field('email'),
            password: new Field('password')
        })

        return {
            formData
        }
    }
}
</script>

<style scoped>

.shape{
    min-width: 500px;
}

.invalid{
    border: 1px solid red;
    box-shadow: 0.1px 0.1px 10px 0px rgba(255, 0, 0, 0.3);
    background-color: rgba(255, 0, 0, 0.1);
}

</style>