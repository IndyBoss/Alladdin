<template>
  <div class="redirect">
    <h1>Processing</h1>
    <div>
      <v-stepper :value="this.stepValue">
        <v-stepper-header>

          <v-stepper-step step="1">Processing message</v-stepper-step>

          <template v-for="(image, index) in task.imagePreviews">
            <v-divider ></v-divider>
            <v-stepper-step
            :key="index"
            :step="(index+2)">Processing media</v-stepper-step>
          </template>

        </v-stepper-header>
      </v-stepper>
      <v-progress-linear
        buffer-value="0"
        :value="this.progressValue"
        height="15"
        rounded="rounded"

        stream
        color="green"
      ></v-progress-linear>
    </div>
  </div>
</template>

<script>
import LocalTaskStorage from '../scripts/LocalTaskStorage';
import FileService from '../scripts/FileService';
import MediaService from '../scripts/MediaService';
import ProcessService from '../scripts/ProcessService';
import TokenService from "../scripts/TokenService";

export default {
  name: 'TaskProcessor',
  data: function() {
    return {
      progressValue: 0,
      stepValue: 2
    }
  },
  beforeRouteEnter (to, from, next) {
    next(vm => {
      (async () => {
        await vm.processTask(vm.task);
        LocalTaskStorage.clearTasks();
        console.log('clearing tasks');
        vm.$router.push({name: 'home'});
      })();
    })
  },
  computed: {
    task: function () {
      return LocalTaskStorage.getCurrentTask();
    }
  },
  methods: {
    async processTask(task) {
      console.log(task);
      const promises = task.platforms.map(async (platform) => {
        switch (platform) {
          case 'twitter':
            this.progressValue = 0;
            return this.twitterProcess(task);
            break;
          case 'facebook':
            this.progressValue = 0;
            return this.facebookProcess(task);
            break;
        }
      })

      const p = await Promise.all(promises)
      return p;
    },
// ********************    TWITTER    ********************
    async twitterProcess(task) {
      const media_ids = [];
      // *** IF MEDIA AVAILABLE ***
      if (task.imagePreviews) {
        // **** FOR EACH FILE PROGRESS THE UPLOAD ****
        for (var i = 0; i < task.imagePreviews.length; i++) {
          this.progressValue = (i+1) * (100 / task.imagePreviews.length);
          this.stepValue = i+2;
          // **** UPLOAD FILES LOCALLY ****
          const localFile = await FileService.uploadIncomingFiles(task.imagePreviews[i]);
          media_ids[i] = await ProcessService.twitterProcessMedia(task.company, localFile.filename, (status) => {
            this.progressValue = status.data.percent;
          });
        }
      }
      // **** POST STATUS WITH MESSAGE ****
      const post = await ProcessService.twitterProcessPost(task.company, media_ids,task.message);
      console.log('twitter processed');
      return post;
    },
// ********************    FACEBOOK    ********************
    async facebookProcess(task) {
      const media_ids = [];
      var type = '';
      const token = await TokenService.getToken();
      // *** IF MEDIA AVAILABLE ***
      if (task.imagePreviews) {
        if (task.imagePreviews.length > 1) {
          // **** FOR EACH FILE PROGRESS THE UPLOAD ****
          for (var i = 0; i < task.imagePreviews.length; i++) {
            this.progressValue = (i+1) * (100 / task.imagePreviews.length);
            this.stepValue = i+2;
            // **** UPLOAD FILES LOCALLY ****
            const localFile = await FileService.uploadIncomingFiles(task.imagePreviews[i]);
            media_ids[i] = await ProcessService.facebookProcessMedia(localFile.filename, token, (status) => {
              this.progressValue = status.data.percent;
            });
          }
          console.log(media_ids);
        } else {
          media_ids[0] = await FileService.uploadIncomingFiles(task.imagePreviews[0]);
          type = task.imageTypes[0]
        }
      }
      // **** POST STATUS WITH MESSAGE ****
      const post = await ProcessService.facebookProcessPost(media_ids, task.message, token, type);
      console.log('facebook processed');
      return post;
    }
  }

}
</script>
