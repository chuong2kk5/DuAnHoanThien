<script setup>
import thongtin from './components/thongtin.vue';
import HelloWorld from './components/HelloWorld.vue'
import TheWelcome from './components/TheWelcome.vue';
import TodoList from './components/TodoList.vue'
import vc from './components/vc.vue'

</script>

<template>
  <header>
    <!-- <img alt="Vue logo" class="logo" src="./assets/logo.svg" width="125" height="125" /> -->

    <div class="wrapper">
      <!-- <thongtin mssv="pk03815" name="chousuny" age="19" lop="wd19" hobby="play soccer" Strengths="eating very much" weakness="sleep very much" /> -->
    </div>
  </header>

  <main>
    <TheWelcome />
    <vc />
  </main>

  <!-- <div id="app">
    <TodoList />
  </div> -->

</template>


<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}
</style>
<!-- <template>
  <div id="app">
    <TodoList />
  </div>
</template>

<script>
import TodoList from './components/TodoList.vue';

export default {
  components: {
    TodoList
  }
};
</script> -->