<template>
  <div class="flex items-center flex-col">
    <h1 class="text-white font-black text-5xl">todos</h1>
    <hr class="p-1 w-10/12">
    <Filter />
    <div id="todos_container" class="p-2 relative flex">
      <Todo />
      <Todo />
      <Todo />
      <Todo />
    </div>
  </div>
</template>



<script>
import Todo from '../components/Todo'
import Filter from '../components/Filter'

export default {
    name: 'Todos',

    components: {
      Todo,
      Filter
    }

}
</script>

<style scoped>

#todos_container{
  min-width: 100vw;
}

</style>
