import MediaService from '../scripts/MediaService';
import TokenService from "../scripts/TokenService";
import axios from 'axios';

class ProcessService {
  static async twitterProcessMedia(company, localFile, callback) {
    return new Promise(async (resolve, reject) => {
      // **** UPLOAD FILES TO TWITTER ****
      const upload = await MediaService.twitterMediaUpload(company, localFile);
      // **** ADD INDIVIDUAL MEDIA FILES ****
      const media_id = upload.data.media_string;
      var status = '';

      // **** CHECK IF UPLOAD STATUS IS PENDING (A VIDEO) / IF NOT -> SKIP TO POST ***
      if (upload.data.state != '') {
        do {
          status = await MediaService.twitterMediaStatus(company, upload.data.media_key, upload.data.company);
          callback(status);
          // **** STATUS LOG ****
          console.log('state: ' + status.data.state + '  percentage: ' + status.data.percent);
        } while (status.data.state === 'in_progress');
        resolve(media_id);
      } else {
        // **** FAKE DATA CALLBACK ****
        setTimeout(() => {
          const s = {data: {percent: 100}}
          console.log('time');
          callback(s);
          resolve(media_id);
        }, 200)
      }
    });
  }

  static async facebookProcessMedia(localFile, token, callback) {
    return new Promise(async (resolve, reject) => {
      var media_id = '';
      const upload = await MediaService.facebookPhotoUpload(localFile, token);
      media_id = upload.data.id;
      // **** FAKE DATA CALLBACK ****
      setTimeout(() => {
        const s = {data: {percent: 100}}
        console.log('time');
        callback(s);
        resolve(media_id);
      }, 200)
    });
  }

  static async facebookProcessPost(media_ids, message, token, imageType) {
    const post = await MediaService.facebookMediaPost(media_ids, message, token, imageType);
    return post;
  }

  static async twitterProcessPost(company, media_ids, message) {
    const post = await MediaService.twitterMediaPost(company, media_ids, message);
    return post;
  }
}
export default ProcessService;
