<template>
  <input type="submit" :value="value" class="outline-none border-2 border-green-300 rounded-full px-6 py-2 cursor-pointer hover:bg-green-500 hover:text-gray-100">
</template> 

<script>
export default {
    name: 'SubmitBtn',

    props: {
        value: { type: String, default: 'Submit' }
    }

}
</script>

<style>

</style>