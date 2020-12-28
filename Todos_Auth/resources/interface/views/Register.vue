<template>
  <div class="flex justify-center items-center py-16" @click.self="c_countries = []">
      <form @submit.prevent="formSubmitted" class="bg-white rounded-lg shadow-lg shape">
          <Alert v-if="alert.visible" :msg="alert.msg" />
          <div class="bg-green-600 px-8 py-3 rounded-t-lg">
              <h1 class="font-black text-4xl text-gray-400">Sign Up</h1>
          </div>
          <div class="p-8">
            <div class="mb-6">
                <label for="fname" class="">First name</label>
                <input type="text" id="fname" v-model="form.fname.val" class="block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded" :class="{'invalid': !form.fname.is_valid}">
                <small v-for="err in form.fname.errors" :key="err" v-text="err" class="text-red-600 pl-4"></small>
            </div>
            <div class="mb-6">
                <label for="lname" class="">Last name</label>
                <input type="text" id="lname" v-model="form.lname.val" :class="{'invalid': !form.lname.is_valid}" class="block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
                <small v-for="(err, index) in form.lname.errors" :key="index" v-text="err" class="text-red-600 pl-4"></small>
            </div>   
            <div class="mb-6">
                <label for="dob" class="">Date Of birth</label>
                <input type="date" id="dob" v-model="form.dob.val" :class="{'invalid': !form.dob.is_valid}" class="block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
                <small v-for="(err, index) in form.dob.errors" :key="index" v-text="err" class="text-red-600 pl-4"></small>
            </div>            
            <div class="mb-6">
                <label for="country" class="">Country</label>
                <div class="relative">
                    <input type="text" id="country" @input="displayCountries" v-model="form.country.val" autocomplete="off" class="block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
                    <div v-if="c_countries.length" class="absolute border border-gray-60 bg-gray-200 min-w-full overflow-y-scroll max-h-96">
                        <span v-for="c in c_countries" :key="c.id" v-text="c.country_name" @click="chooseCountry(c)" class="block p-3 hover:bg-gray-300 cursor-pointer"></span>
                    </div>
                </div>
            </div>             
            <div class="mb-6">
                <label for="address" class="">Address</label>
                <input type="text" id="address" :class="{'invalid': !form.address.is_valid}" v-model="form.address.val" maxlength="255" autocomplete="off" class="block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
                <small v-for="(err, index) in form.address.errors" :key="index" v-text="err" class="text-red-600 pl-4"></small>
            </div>            
            <div class="mb-6">
                <label for="email" class="">E-mail</label>
                <input type="email" id="email" v-model="form.email.val" :class="{'invalid': !form.email.is_valid}" class="block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
                <small v-for="(err, index) in form.email.errors" :key="index" v-text="err" class="text-red-600 pl-4"></small>
            </div>             
            <div class="mb-6">
                <label for="phone" class="">Phone number</label>
                <div class="mt-3 min-w-full rounded flex">
                    <select class="outline-none bg-white border-green-300 rounded-l border-2 border-r-0 slc">
                        <option v-for="cc in callingCodes" :key="cc" :value="cc" v-text="'+' + cc" class="p-2 bg-gray-300"></option>
                    </select>
                    <input type="text" id="phone" maxlength="10" :class="{'invalid': !form.phone.is_valid}" v-model="form.phone.val" class="px-3 flex-grow py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded-r">
                </div>
                <small v-for="(err, index) in form.phone.errors" :key="index" v-text="err" class="text-red-600 pl-4"></small>
            </div>            
            <div class="mb-6">
                <label for="password" class="">Password</label>
                <input type="password" id="password" v-model="form.password.val" :class="{'invalid': !form.password.is_valid}" class="ring-2 ring-green-300 block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
                <small v-for="(err, index) in form.password.errors" :key="index" v-text="err" class="text-red-600 pl-4"></small>
            </div>            
            <div class="mb-6">
                <label for="password_confirm" class="">Repeate Password</label>
                <input type="password" id="password_confirm" v-model="form.password_confirm.val" :class="{'invalid': !form.password_confirm.is_valid}" class="ring-2 ring-green-300 block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
                <small v-for="(err, index) in form.password_confirm.errors" :key="index" v-text="err" class="text-red-600 pl-4"></small>
            </div>            
            <div class="mb-6">
                <div class="flex items-center">
                    <input type="checkbox" v-model="form.termsChecked.val" class="mr-4 h-5 w-5 text-white checked:bg-green-700 checked:border-transparent">
                    <a href="javascript:void(0)" class="text-blue-500 pb-1 hover:underline">
                        <label for="terms">
                            <small>Accept Terms & Conditions</small>
                        </label>
                    </a>
                </div>
                <small v-for="(err, index) in form.termsChecked.errors" :key="index" v-text="err" class="min-w-full text-red-600 pl-4"></small>
            </div>
            <SubmitBtn value="Sign Up"/>
          </div>
      </form>
  </div>
</template>






<script>
import SubmitBtn from '../components/SubmitBtn'
import axios from 'axios'
import Alert from '../components/Alert'
import Mixin from '../mixins'
import Field from '../utilities/validation'
import { ref } from 'vue'

export default {
    name: 'Register',

    mixins: [Mixin],

    components: {
        SubmitBtn,
        Alert
    },

    data(){
        return {
            countries: [],

            c_countries: [],

            callingCodes: [],
        }
    },

    methods: {

        chooseCountry(country){
            this.c_countries = []
            this.form.country_id.val = country.id
            this.form.country.val = country.country_name
            this.callingCodes = country.calling_codes.filter(x => x != null)
        },

        displayCountries(){
            this.c_countries = []
            this.countries.forEach(cnt => {
                if(cnt.country_name.substr(0, this.form.country.val.trim().length).toLowerCase() == this.form.country.val.trim().toLowerCase()){
                    this.c_countries.push(cnt)
                }
            });
        },

        formIsValid(){

            this.form.password_confirm.require('password confirmation is required').sameAs(this.form.password, 'passwords should match')
            this.form.address.require('address is required').max(255, 'address should not have more than 200 caracters')
            this.form.termsChecked.require('You should Agree to Our Terms & Conditions')
            this.form.country_id.require('country is required')
            this.form.dob.require('date of birth is required')
            this.form.password.require('password is required')
            this.form.fname.require('first name is required')
            this.form.lname.require('last name is required')
            this.form.email.require('email is required')
            this.form.phone.require('phone is required')

            for(let key in this.form){
                if(!this.form[key].is_valid){
                    return false
                }
            }

            return true
        },

        formSubmitted(){

            for(let key in this.form){
                this.form[key].reset()
            }

            if(this.formIsValid()){
                let formData = new FormData()

                for(let key in this.form){
                    if(key != 'country'){
                        formData.append(key, this.form[key].val)
                    }
                }
                
                axios.post('api/users', formData)
                    .then((resp)=>{
                        router.push({name: 'Home'})
                    }).catch((err)=>{
                        this.alrt()
                    })
            }

        }
    },

    mounted(){
        axios.get('/api/countries')
              .then((resp)=>{
                  this.countries = resp.data
              }).catch(()=>{

              })
    },

    setup(){

        let form = ref({
            fname: new Field('fname'),
            lname: new Field('lname'),
            dob: new Field('dob'),
            password: new Field('password'),
            password_confirm: new Field('password_confirm'),
            email: new Field('email'),
            address: new Field('address'),
            phone: new Field('phone'),
            country_id: new Field('country_id'),
            country: new Field('country'),
            termsChecked: new Field('termsChecked', true, false),
        })

        return {
            form
        }
    }
}
</script>







<style scoped>

.shape{
    min-width: 500px;
}

.slc{
    min-width: 80px;
}

.invalid{
    border: 1px solid red;
    box-shadow: 0.1px 0.1px 10px 0px rgba(255, 0, 0, 0.3);
    background-color: rgba(255, 0, 0, 0.1);
}

</style>