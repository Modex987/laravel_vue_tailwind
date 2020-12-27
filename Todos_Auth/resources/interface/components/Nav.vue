<template>
  <nav class="bg-green-600 flex justify-between items-center px-6 py-2 text-gray-400">
      <div>
          <router-link :to="{name: 'Home'}">
              <h1 class="font-black text-4xl">Todos app</h1>
          </router-link>
      </div>
      <ul class="flex justify-between items-center">
          <li class="mx-3 border-2 rounded-full hover:bg-blue-600 py-2 px-3 transition duration-500 ease-in">
              <router-link :to="{name: 'Login'}">Log In</router-link>
          </li>          
          <li class="mx-3 border-2 rounded-full hover:bg-blue-600 py-2 px-3 transition duration-500 ease-in">
              <router-link :to="{name: 'Register'}">Sign Up</router-link>
          </li>
      </ul>
  </nav>
</template>

<script>
export default {
    name: 'Nav'

}
</script>

<style>

</style>