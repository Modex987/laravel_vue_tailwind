<template>
  <div class="w-screen p-1 flex flex-col items-center" @click.self="c_countries = []" v-if="onProfile">

    <h1 class="text-3xl mb-3">
      <b class="font-black">
        {{ contact.fname }} {{ contact.lname }}
      </b>
      Infos
    </h1>

    <span class="rounded border-2 border-gray-700 shadow-xl text-center bg-yellow-300 mx-auto py-2 px-6 font-black text-xl mb-3">
      last updated: {{contact.updated_at}}
    </span>

    <div id="contact" class="bg-gray-300 rounded p-3 mb-3">
      <button @click="toggleContactMode" class="text-blue-700 float-right hover:underline focus:outline-none">
        {{isContactEditMode ? 'Save' : 'Edit'}}
      </button>
      <fieldset :disabled="!isContactEditMode">

        <div class="m-2">
          <label class="mx-2" for="fname">First name</label>
          <input type="text" id="fname" v-model="formData.fname.val" class="p-1 rounded">
          <small v-for="(err, index) in formData.fname.errors" :key="index" v-text="err" class="min-w-full text-red-600 pl-4"></small>
        </div>

        <div class="m-2">
          <label class="mx-2" for="lname">Last name</label>
          <input type="text" id="lname" v-model="formData.lname.val" class="p-1 rounded">
          <small v-for="(err, index) in formData.lname.errors" :key="index" v-text="err" class="min-w-full text-red-600 pl-4"></small>
        </div>

        <div class="m-2">
          <label class="mx-2" for="dob">Date of birth</label>
          <input v-if="isContactEditMode" type="date" id="dob" v-model="formData.dob.val" class="p-1 rounded">
          <input v-if="!isContactEditMode" type="text" v-model="formData.dob.val" class="p-1 rounded">
          <small v-for="(err, index) in formData.dob.errors" :key="index" v-text="err" class="min-w-full text-red-600 pl-4"></small>
        </div>

        <div class="m-2">
          <label class="mx-2" for="address">Address</label>
          <input type="text" id="address" v-model="formData.address.val" class="p-1 rounded">
          <small v-for="(err, index) in formData.address.errors" :key="index" v-text="err" class="min-w-full text-red-600 pl-4"></small>
        </div>

        <div class="m-2 relative">
          <label class="mx-2" for="country">country</label>
          <input type="text" id="country" v-model="formData.country.val" @input="displayCountries" class="p-1 rounded">
          <small v-for="(err, index) in formData.country.errors" :key="index" v-text="err" class="min-w-full text-red-600 pl-4"></small>
          <div v-if="c_countries.length" class="absolute border border-gray-60 bg-gray-200 min-w-full overflow-y-scroll max-h-96">
              <span v-for="c in c_countries" :key="c.id" v-text="c.country_name" @click="chooseCountry(c)" class="block p-3 hover:bg-gray-300 cursor-pointer"></span>
          </div>
        </div>
        <div class="m-2">
          <label class="mx-2" for="phone">Phone</label>
          <select class="p-1 rounded-l">
              <option v-for="cc in formData.callingCodes.val" :key="cc" :value="cc" v-text="'+' + cc"></option>
          </select>
          <input type="text" id="phone" maxlength="10" v-model="formData.phone.val" class="p-1 rounded-r">
          <small v-for="(err, index) in formData.phone.errors" :key="index" v-text="err" class="min-w-full text-red-600 pl-4"></small>
        </div>

      </fieldset>
    </div>

    <div id="contact" class="bg-gray-300 rounded p-3">
      <button @click="toggleUserMode" class="text-blue-700 float-right hover:underline focus:outline-none">
        {{isUserEditMode ? 'Save' : 'Edit'}}
      </button>
      <fieldset :disabled="!isUserEditMode">
        <div class="m-2">
          <label class="mx-2" for="email">E-mail</label>
          <input type="email" required id="email" v-model="user.email" class="p-1 rounded">
        </div>
      </fieldset>
    </div>
  </div>
</template>



<script>
import { useStore } from 'vuex'
import Field from '../utilities/validation'

export default {
    name: 'Profile',

    computed: {
      contact(){
        return this.store.state.contact
      },

      user(){
        return this.store.state.user
      },

      // callingCodes(){
      //   return this.store.state.contact.country.calling_codes
      // },

      formData(){
        return {
                fname: new Field('fname', true, this.store.state.contact.fname),
                lname: new Field('lname', true, this.store.state.contact.lname),
                dob: new Field('dob', true, this.store.state.contact.dob),
                address: new Field('address', true, this.store.state.contact.address),
                phone: new Field('phone', true, this.store.state.contact.phone),
                country_id: new Field('country_id', true, this.store.state.contact.country.id),
                country: new Field('country', true, this.store.state.contact.country.country_name),
                // callingCodes: new Field('country', true, this.store.state.contact.country.calling_codes),
                callingCodes: new Field('country', true, this.cleanCallingCodes(this.store.state.contact.country.calling_codes)),
              }
      }
    },

    methods: {

      formIsValid(){
        this.formData.address.require('address is required').max(255, 'address should not have more than 200 caracters')
        this.formData.country_id.require('country is required')
        this.formData.dob.require('date of birth is required')
        this.formData.fname.require('first name is required')
        this.formData.lname.require('last name is required')
        this.formData.country.require('country name is required')
        this.formData.phone.require('phone is required')

        for(let key in this.formData){
            if(!this.formData[key].is_valid){
                return false
            }
        }

        return true
      },

      toggleContactMode(){
        if(!this.isContactEditMode){
          axios.get('/api/countries')
                .then((resp)=>{
                    this.countries = resp.data
                }).catch(()=>{

                })
        }else{
          this.c_countries = []

          for(let key in this.formData){
            this.formData[key].reset()
          }

          if(this.formIsValid()){

            this.store.commit('updateContact', {
              fname: this.formData.fname.val,
              lname: this.formData.lname.val,
              dob: this.formData.dob.val,
              address: this.formData.address.val,
              phone: this.formData.phone.val,
              country_id: this.formData.country_id.val,
            })

          } else {
            return
          }
        }
        this.isContactEditMode = !this.isContactEditMode
      },

      toggleUserMode(){
        if(this.isUserEditMode){
          this.store.commit('updateMail')
        }
        this.isUserEditMode = !this.isUserEditMode
      },

      cleanCallingCodes(L){
        return L.filter((elm)=>{
          return Boolean(Number(elm))
        })
      },

      chooseCountry(country){
        this.c_countries = []
        this.formData.country_id.val = country.id
        this.formData.country.val = country.country_name
        this.formData.callingCodes.val = this.cleanCallingCodes(country.calling_codes)
        // this.formData.country_id.val = country.id
        // this.formData.country.val = country.country_name
        // this.callingCodes = country.calling_codes.filter(x => x != null)
      },

      displayCountries(){
        this.c_countries = []
        let c = this.formData.country.val
        this.countries.forEach(cnt => {
          if(cnt.country_name.substr(0, c.trim().length).toLowerCase() == c.trim().toLowerCase()){
              this.c_countries.push(cnt)
          }
        });
      },
    },

    data(){
      return {
        store: useStore(),

        isContactEditMode: false,
        isUserEditMode: false,

        onProfile: false,

        countries: [],
        c_countries: [],
        // callingCodes: [],
      }
    },

    mounted(){
      this.onProfile = true
    },

    beforeUnmount(){
      this.onProfile = false
    }

}
</script>



<style scoped>

#contact{
  max-width: 1000px;
  min-width: 800px;
}

</style>