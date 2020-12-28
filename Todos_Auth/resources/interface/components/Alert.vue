<template>
    <div class="absolute px-8 pt-2 opacity-75">
        <div class="px-4 py-2 bg-red-600 rounded">
            <b class="font-black text-red-900">Alert! </b>{{msg}}
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
}
</style> 