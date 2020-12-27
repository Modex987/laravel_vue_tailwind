<template>
  <div class="flex">
      <div class="bg-blue-600 p-12 py-14 rounded-full m-12 transition ease-in-out duration-500" :class="{'shape': shape.applied}">Todos</div>
  </div>
</template>

<script>
import { onMounted, onUnmounted, ref } from 'vue'

export default {
    name: 'Home',

    setup(){
        let shape = ref({
            applied: false,
            intervall: null,
            timeOut: null
        })

        onMounted(()=>{
            shape.value.intervall = setInterval(()=>{
                shape.value.applied = !shape.value.applied
                shape.value.timeOut = setTimeout(()=>{
                    shape.value.applied = !shape.value.applied
                        shape.value.timeOut = setTimeout(()=>{
                            shape.value.applied = !shape.value.applied
                            shape.value.timeOut = setTimeout(()=>{
                                shape.value.applied = !shape.value.applied
                            }, 250)
                        }, 250)
                }, 250)
            }, 2000)            
        })

        onUnmounted(()=>{
            clearInterval(shape.value.intervall)
            clearTimeout(shape.value.timeOut)
        })

        return { shape }
    }

}
</script>

<style scoped>

.shape{
    transform: scale(1.5);
}

</style>