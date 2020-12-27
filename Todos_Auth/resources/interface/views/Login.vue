<template>
  <div class="flex justify-center items-center pt-16">
      <form @submit.prevent="" class="bg-white rounded-lg shadow-lg shape">
          <div class="bg-green-600 px-8 py-3 rounded-t-lg">
              <h1 class="font-black text-4xl text-gray-400">Login</h1>
          </div>
          <div class="p-8">
            <div class="mb-6">
                <label for="email" class="">E-mail</label>
                <input type="email" id="email" class="ring-2 ring-green-300 block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
            </div>
            <div class="mb-6">
                <label for="password" class="">Password</label>
                <input type="password" id="password" class="ring-2 ring-green-300 block mt-3 min-w-full px-3 py-2 outline-none border-2 border-green-300 focus:border-green-700 rounded">
            </div>
            <SubmitBtn value="Login"/>
          </div>
      </form>
  </div>
</template>

<script>
import SubmitBtn from '../components/SubmitBtn'
export default {
    name: 'Login',

    components: {
        SubmitBtn
    }
}
</script>

<style scoped>

.shape{
    min-width: 500px;
}

</style>