<template>
    <div class="absolute top-4 sm:right-4/12 px-8 pt-2 opacity-75">
        <div class="px-4 py-2 bg-red-600 rounded flex items-center">
            <b class="font-black text-red-900 mr-2">Alert! </b><small>{{msg}}</small>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Alert',

    props: {
        msg: String
    }

}
</script>

<style scoped>
div.absolute{
    min-width: 500px;
    z-index: 1000000000000000;
}
</style> 