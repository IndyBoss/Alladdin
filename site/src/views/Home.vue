<template>
  <div class="home">
    <h1 style="padding-bottom:50px">SocialMole</h1>
    <v-row justify="space-around">
      <v-btn height="150px" width="150px" @click="ida()" icon>
        <v-avatar size="150px" color="primary">
          <span class="white--text headline">IDA</span>
        </v-avatar>
      </v-btn>
      <v-btn height="150px" width="150px" @click="twopointo()" icon>
        <v-avatar size="150px" color="primary">
          <span class="white--text headline">2.O</span>
        </v-avatar>
      </v-btn>
      <v-btn height="150px" width="150px" @click="fectiv()" icon>
        <v-avatar size="150px" color="primary">
          <span class="white--text headline">Fectiv</span>
        </v-avatar>
      </v-btn>
    </v-row>
  </div>
</template>

<script>
export default {
  name: 'Home',
  methods: {
    ida() {
      this.$router.push({name: 'ida'});
    },
    twopointo() {
      this.$router.push({name: '2pointo'});
    },
    fectiv() {
      this.$router.push({name: 'fectiv'});
    }
  }
}
</script>
