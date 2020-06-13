import PostFactory from "../scripts/PostFactory";
import axios from 'axios';

class MediaService {

  static async twitterMediaUpload(company, media_data) {
    return new Promise((resolve, reject) => {
      axios
        .post("http://localhost:4000/twitterfilesupload", {
          method: "POST",
          headers: {
            "content-type": "multipart/form-data",
            'Accept': 'multipart/form-data'
          },
          body: PostFactory.createTweetTokenMedia(company,'','',media_data,'')
        })
        .then(response => {
          return resolve(response);
       })
       .catch(error => {
         return reject(error)
       });
    });
  }

  static async twitterMediaStatus(company, data) {
    return new Promise((resolve, reject) => {
      axios
        .post("http://localhost:4000/twitterfilesstatus", {
          method: "POST",
          headers: {
            "content-type": "multipart/form-data",
            'Accept': 'multipart/form-data'
          },
          body: PostFactory.createTweetTokenMedia(company, data)
        })
        .then(response => {
          return resolve(response);
       })
       .catch(error => {
         return reject(error)
       });
    });
  }

  static async twitterMediaPost(company, media_id, media) {
    return new Promise((resolve, reject) => {
      axios
        .post("http://localhost:4000/twitterfilespost", {
          method: "POST",
          headers: {
            "content-type": "multipart/form-data",
            'Accept': 'multipart/form-data'
          },
          body: PostFactory.createTweetTokenMedia(company, media_id, media)
        })
        .then(response => {
          return resolve(response);
       })
       .catch(error => {
         return reject(error)
       });
    });
  }
  // *********************************************
  // ************** F A C E B O O K **************
  // *********************************************
  static async facebookMediaPost(media_ids, message, token, imageType) {
    return new Promise((resolve, reject) => {
      axios
        .post("http://localhost:4000/facebookmediapost", {
          method: "POST",
          headers: {
            "content-type": "multipart/form-data",
            'Accept': 'multipart/form-data'
          },
          body: PostFactory.createFacebook(message, token, '', media_ids, imageType)
        })
        .then(response => {
          return resolve(response);
       })
       .catch(error => {
         return reject(error)
       });
    });
  }

  static async facebookPhotoUpload(file, token) {
    return new Promise((resolve, reject) => {
      axios
        .post("http://localhost:4000/facebookphotoupload", {
          method: "POST",
          headers: {
            "content-type": "multipart/form-data",
            'Accept': 'multipart/form-data'
          },
          body: PostFactory.createFacebook('',token,file)
        })
        .then(response => {
          return resolve(response);
       })
       .catch(error => {
         return reject(error)
       });
    });
  }

}
export default MediaService;
