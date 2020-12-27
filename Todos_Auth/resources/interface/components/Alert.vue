<template>
    <div class="px-8 pt-2">
        <div class="px-4 py-2 bg-red-600 rounded">
            <b class="font-black">Alert! </b>{{msg}}
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

<style>

</style> 