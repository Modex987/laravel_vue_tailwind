<template>
  <div class="flex justify-center items-center py-16" @click.self="autoCompleteCountries = []">
      <form @submit.prevent="formSubmitted" class="bg-white rounded-lg shadow-lg shape">
          <div class="bg-green-600 px-8 py-3 rounded-t-lg">
              <h1 class="font-black text-4xl text-gray-400">Sign Up</h1>
          </div>
          <Alert v-if="alert.visible" :msg="alert.msg" />
          <div class="p-8">
            <div class="mb-6">
                <label for="fname" class="">First name</label>
                <input type="text" id="fname" v-model="form.fname" class="block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
            </div>
            <div class="mb-6">
                <label for="lname" class="">Last name</label>
                <input type="text" id="lname" v-model="form.lname" class="block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
            </div>   
            <div class="mb-6">
                <label for="dob" class="">Date Of birth</label>
                <input type="date" id="dob" v-model="form.dob" class="block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
            </div>            
            <div class="mb-6">
                <label for="country" class="">Country</label>
                <div class="relative">
                    <input type="text" id="country" v-model="form.country.name" @input="autoComplete" autocomplete="off" class="block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
                    <div v-if="autoCompleteCountries.length" class="absolute border border-gray-60 bg-gray-200 min-w-full overflow-y-scroll max-h-96">
                        <span class="block p-3 hover:bg-gray-300 cursor-pointer" @click="chooseCountry(country)" v-for="(country, index) in autoCompleteCountries" :key="index" v-text="country.name"></span>
                    </div>
                </div>
            </div>            
            <div class="mb-6">
                <label for="email" class="">E-mail</label>
                <input type="email" id="email" v-model="form.email" class="block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
            </div>             
            <div class="mb-6">
                <label for="phone" class="">Phone number</label>
                <div class="block mt-3 min-w-full rounded flex">
                    <select class="outline-none bg-white border-green-300 rounded-l border-2 border-r-0 slc" v-model="form.country.callingCode">
                        <option v-for="cc in callingCodes" :key="cc" :value="cc" v-text="'+' + cc" class="p-2 bg-gray-300"></option>
                    </select> 
                    <input type="text" id="phone" maxlength="9" v-model="form.phone" class="px-3 flex-grow py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded-r">
                </div>
            </div>            
            <div class="mb-6">
                <label for="password" class="">Password</label>
                <input type="password" id="password" v-model="form.password" class="ring-2 ring-green-300 block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
            </div>            
            <div class="mb-6">
                <label for="password_confirm" class="">Repeate Password</label>
                <input type="password" id="password_confirm" v-model="form.password_confirm" class="ring-2 ring-green-300 block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
            </div>            
            <div class="mb-6 flex items-center">
                <input type="checkbox" v-model="form.termsChecked" class="mr-4 h-5 w-5 text-white checked:bg-green-700 checked:border-transparent">
                <a href="javascript:void(0)" class="text-blue-500 pb-1 hover:underline"><label for="terms"><small>Accept Terms & Conditions</small></label></a>
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

export default {
    name: 'Register',

    mixins: [Mixin],

    components: {
        SubmitBtn,
        Alert
    },


    computed: {

    },

    methods: {
        formSubmitted(){
            let formData = new FormData()
            for(const prop in this.form){
                if(prop === 'country'){
                    if(this.form[prop].name && this.form[prop].callingCode){
                        formData.append('country', this.form[prop].name)
                        formData.append('callingCode', this.form[prop].callingCode)
                    }else{
                        this.alrt('Country name and Calling Country Code are required')
                        return
                    }
                }else{
                    if(this.form[prop]){
                        formData.append(prop, this.form[prop])
                    }else{
                        this.alrt(this.syno(prop) + ' is required')
                        return
                    }
                }
            }

            if(this.form.password === this.form.password_confirm){
                axios.post('/api/users', formData)
                     .then((resp)=>{
                        console.log(resp.data)
                        // 
                    }).catch((error)=>{
                        this.alrt(error.response.data.errors.email[0])
                    })
            }else{
                this.alrt(this.syno('password_confirm') + ' is required')
                return
            }
        },

        autoComplete(){
            this.autoCompleteCountries = []
            this.countries.forEach( elm =>{
                if(elm.name.substr(0, this.form.country.name.length).toUpperCase() == this.form.country.name.toUpperCase()){
                    this.autoCompleteCountries.push(elm)
                }
            })
        },

        chooseCountry(country){
            this.form.country.name = country.name
            this.callingCodes = country.callingCodes
            this.autoCompleteCountries = []
        },

        syno(word){
            switch( word ) {
                case 'fname':
                    return 'first name'
                    break;                
                case 'lname':
                    return 'last name'
                    break;                
                case 'dob':
                    return 'Date Of Birth'
                    break;                
                case 'phone':
                    return 'phone number'
                    break;                
                case 'termsChecked':
                    return 'Accepting Terms & Conditions'
                    break;                
                case 'password_confirm':
                    return 'Confirming password'
                    break;

                default:
                    return word;
            }
        }
    },

    data(){
        return {

            countries: [],
            autoCompleteCountries: [],
            callingCodes: [],

            form: {
                fname: null,
                lname: null,
                dob: null,
                email: null,
                phone: null,
                password: null,
                password_confirm: null,
                termsChecked: false,
                country: {
                    name: null,
                    callingCode: null
                },

            },

        }
    },

    mounted(){
        axios.get('https://restcountries.eu/rest/v2/all')
             .then((resp)=>{
                 resp.data.forEach(elm => {
                     let country = {}
                     country.name = elm.name
                     country.callingCodes = elm.callingCodes
                     this.countries.push(country)
                 })
             }).catch(err => {
                     console.log(err.message)
                });
    },

    unmounted(){
        clearTimeout(this.timeOut)
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

</style>