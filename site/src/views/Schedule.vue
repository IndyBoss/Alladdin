<template>
  <div class="schedule">
    <router-link id="planningBtn" to='ida' style="width: 100px;">
      <p> < Terug</p>
    </router-link>
    <div v-for="(item, index) in list" style="color:white">
      <h3><b>id: {{ item.id }}</b></h3>
      <p>company: {{item.company}}</p>
      <p>date: {{item.date}}</p>
      <p>status: {{item.status}}</p>
      <p>platforms: {{item.platforms}}</p>
      <p>imagePreviews: {{item.imagePreviews}}</p>
      <p>imageTypes: {{item.imageTypes}}</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'schedule',
  data: function () {
    return {
      list: null
    }
  },
  mounted() {
    axios
      .get("http://localhost:4000/getschedule")
      .then(response => (this.list = response.data))
  }
}
</script>
