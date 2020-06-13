import config from '../config/config';

class PostFactory {
    static createFacebook(message, access_token, filename, media, imageType) {
      const resultJSON = {
        message,
        access_token,
        filename,
        media,
        imageType
      };
      return resultJSON;
    }

    static createTweetTokenMedia(company, media_id, media, media_data, segment_index, media_type, total_bytes) {
      const resultJSON = {
        "ck": config[company].twitter.CONSUMER_KEY,
        "cs": config[company].twitter.CONSUMER_SECRET_KEY,
        "tk": config[company].twitter.TOKEN,
        "ts": config[company].twitter.SECRET_TOKEN,
        media_id,
        media,
        media_data,
        segment_index,
        media_type,
        total_bytes,
        company
      };
      return resultJSON;
    }
}
export default PostFactory;
