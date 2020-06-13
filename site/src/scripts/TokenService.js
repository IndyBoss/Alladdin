import axios from 'axios';

class TokenService {

  constructor() {
    this.currentPageToken = '';
  }

  static async getToken() {
    this.currentPageToken = '';
    if(!this.currentPageToken) {
      try {
        const userToken = await this.createUserToken();
        const pageToken = await this.createPageToken(userToken);
        this.currentPageToken = pageToken;
      } catch(error) {
        console.error(`couldn 't get tokens: ${error}`);
      }
    }
    return this.currentPageToken;
  }

  static async createUserToken() {
    return new Promise((resolve, reject) => {
      axios
        .get('https://graph.facebook.com/184599179578811/accounts/test-users?access_token=184599179578811|KvG8LraY1-GEaHSHXh5H-j8EQ80')
        .then(response => {
          return resolve(response.data.data[0].access_token);
       })
       .catch(error => {
         return reject(error)
       });
    });
  }

  static async createPageToken(userToken) {
    return new Promise((resolve, reject) => {
      axios
        .get('https://graph.facebook.com/105876800991936', {
          params: {
            access_token: userToken,
            fields: 'access_token'
          }
        })
        .then(response => {
          return resolve(response.data.access_token)
        })
        .catch(error => {
          return reject(error)
        });
    });
  }
}

export default TokenService;
