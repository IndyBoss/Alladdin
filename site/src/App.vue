<template>
  <div id="app">
    <v-app>
    <!-- <nav>
      <router-link to='/'>Home </router-link>
      <router-link to='/post'> Post</router-link>
    </nav> -->
    <router-view  />
  </v-app>
  </div>
</template>

<script>
export default {
  name: 'app',
  mounted() {
    
  }
}
</script>
