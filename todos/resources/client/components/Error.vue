<template>
    <div class="mb-8 text-left">
        <h1 class="bg-red-600 text-cool-gray-800 p-4 rounded">
            <b class="font-bold">Error! </b>
            <span v-text="message" class=""></span>
        </h1>
    </div>
</template>

<script>
export default {
    name: 'Error',

    props: {
        message: { type: String, default: 'Something Went Wrong'}
    }

}
</script>

<style>

</style>