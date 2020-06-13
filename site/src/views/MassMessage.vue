<template>
  <div class="fullMessage">
      <v-sheet
        height="100vh"
        style="position: relative;"
      >
            <div class="massMessage">
              <div id="sideNav">
                <h1>SocialMole</h1>
                <ul>
                  <li v-for="item in items">
                    <router-link :to=item.link>
                      {{ item.title }}
                    </router-link>
                  </li>
                </ul>
                <router-link id="planningBtn" to='schedule'>
                  <v-icon>far fa-calendar-alt</v-icon>
                  <p>Planning</p>
                </router-link>
              </div>

              <form id="messageForm" @submit="send">
                <div class="radio-group" v-model="isPlannerActive">
                  <input type="radio" id="post" value="false" v-model="isPlannerActive" v-on:click="plannerActiveCheck()">
                  <label for="post">Bericht</label>
                  <input type="radio" id="plan" value="true" v-model="isPlannerActive" v-on:click="plannerActiveCheck()">
                  <label for="plan">Plannen</label>
                </div>

                <div id="formText">
                  <div id="formTextLeft">
                    <v-container>
                      <div class="msgSchedule">
                      </div>
                    </v-container>
                    <v-container class="validationError" v-if="!$v.bodyText.required">Veld is verplicht</v-container>
                    <v-container class="validationError" v-if="!$v.bodyText.minLength">Het bericht moet op zijn minst {{$v.bodyText.$params.minLength.min}} karakters lang zijn.</v-container>
                    <v-container class="validationError" v-if="this.bodyText.length > 280 && platforms.includes('twitter')">Tweets hebben max. 280 karakters.</v-container>
                  </div>
                  <div id="formTextRight">
                    <v-date-picker v-model="date" class="mt-4" color="#FC7355" header-color="#FC7355"></v-date-picker>
                  </div>
                </div>

                <div id="formInput">
                  <div id="formSocials">
                    <p>Media Keuze</p>
                    <v-container>
                      <v-btn-toggle v-model="platforms" multiple group>
                        <v-btn class="socialButtons" value="facebook">
                          <v-icon large>fab fa-facebook-f</v-icon>
                        </v-btn>
                        <v-btn class="socialButtons" value="twitter">
                          <v-icon large>fab fa-twitter</v-icon>
                        </v-btn>
                      </v-btn-toggle>
                    </v-container>
                  </div>
                  <v-divider vertical inset color="#FC7355" style="border-width: 0.6px;"></v-divider>
                  <div id="formUpload">
                    <p class="uploadTitel">Bestanden uploaden</p>
                    <p class="small">Max. 4 foto's of 1 Video/GIF</p>
                      <!-- <input type="file" id="files" class="inputfile" ref="files" accept="*/*" multiple v-on:change="handleFilesUpload()"/> -->
                    <v-file-input v-model="files" color="#FC7355" counter dense multiple accept="*/*" placeholder="Select your files" prepend-icon="mdi-paperclip" outlined :show-size="1000" v-on:change="handleFilesUpload()">
                      <template v-slot:selection="{ index, text }">
                        <v-chip v-if="index < 2" color="#FC7355" dark label small>
                          {{ text }}
                        </v-chip>
                        <span v-else-if="index === 2" class="overline grey--text text--darken-3 mx-2">
                          +{{ files.length - 2 }} File(s)
                        </span>
                      </template>
                    </v-file-input>
                  </div>
                </div>

                <v-btn class="msgBtn" type="submit" :disabled="$v.$invalid || this.bodyText.length > 280 && platforms.includes('twitter')" >VERSTUREN</v-btn>
              </form>
            </div>
      </v-sheet>
  </div>
</template>

<script>
import FileService from "../scripts/FileService";
import { required, minLength, maxLength } from "vuelidate/lib/validators";
import LocalTaskStorage from '../scripts/LocalTaskStorage';
import ServerTaskStorage from '../scripts/ServerTaskStorage';

export default {
  name: 'MassMessage',
  components: { TextareaEmojiPicker },
  data: function () {
    return {
      files: [],
      images: [],
      bodyText: "",
      imagePreviews: [],
      platforms: [
        "twitter",
        "facebook"
      ],
      date: "",
      f: null,
      isPlannerActive: false,
      items: [
        { title: 'IDA', link: 'ida' },
        { title: '2.O', link: '2pointo' },
        { title: 'Fectiv', link: 'fectiv' },
      ],
      mini: true
    }
  },
  validations: {
    bodyText: {
      required,
      minLength: minLength(4)
    }
  },
  mounted() {
  },
  methods: {
    plannerActiveCheck() {
      var planner = document.getElementById("formTextRight");
      if (planner.style.display == "block"){
        planner.style.display = "none";
      } else {
        planner.style.display = "block";
      }
    },
    async send() {
      const d = new Date()
      const today = new Date(d.getFullYear(), d.getMonth(), d.getDate());
      const someday = new Date(this.date.split("-"));
      const taskProcess = this.taskProcess();
      if (today.getDate() === someday.getDate() || this.date == "") {
        this.$router.push({name: 'taskprocessor'});
      }
    },
    async taskProcess() {
      const d = new Date()
      const today = new Date(d.getFullYear(), d.getMonth(), d.getDate());
      const someday = new Date(this.date.split("-"));
      console.log(this.files);
      if (this.files.length > 0) {
        var imagePreviews = [];
        var imageTypes = [];
        const imageFormData = new FormData();
        for (var i = 0; i < this.files.length; i++) {
          imagePreviews[i] = FileService.imageToFormdData(this.files[i]);
          imageTypes[i] = this.files[i].type;
          imageFormData.append(`media`, this.files[i])
        }
        if (today.getDate() === someday.getDate() || this.date == "") {
          LocalTaskStorage.addMessageTask(this.$route.name, this.date, this.bodyText, this.platforms, imagePreviews, imageTypes);
        } else {
          const filenames = await FileService.uploadServerFiles(imageFormData);
          ServerTaskStorage.addServerTask(this.$route.name, this.date, this.bodyText, this.platforms, filenames, imageTypes);
        }
      } else {
        if (today.getDate() === someday.getDate() || this.date == "") {
          LocalTaskStorage.addMessageTask(this.$route.name, this.date, this.bodyText, this.platforms);
        } else {
          ServerTaskStorage.addServerTask(this.$route.name, this.date, this.bodyText, this.platforms);
        }
      }
    },

    async handleFilesUpload() {
      this.images = await this.getImagePreviews();
    },


    async getImagePreviews() {
      var images = [];

      for( let i = 0; i < this.files.length; i++ ){
        if ( /\.(jpe?g|png|gif)$/i.test( this.files[i].name ) ) {
          const imageRes = await FileService.readFile(this.files[i]);
          const size = this.files[i].size;
          if (this.$refs && this.$refs[`image${i}`] && this.$refs[`image${i}`][0]) {
            this.$refs[`image${i}`][0].src = imageRes;
          }
          images.push({image: imageRes, size: size});
        }
      }
      return images;
    }

  }
};
</script>
