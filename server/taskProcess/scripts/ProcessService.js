const FacebookService = require('./FacebookService');

class ProcessService {
  static async facebookProcessMedia(localFile, token) {
    return new Promise(async (resolve, reject) => {
      const media_id = await FacebookService.facebookPhotoUpload(localFile, token);
      resolve(media_id);
    });
  }
}
module.exports = ProcessService;
