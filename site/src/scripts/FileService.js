import MediaService from '../scripts/MediaService';
import axios from 'axios';

class FileService {

  static imageToFormdData(thisFile) {
    const formData = new FormData();
    const file = thisFile;
    formData.append('file', file);
    return formData
  }

  static async readFile(file) {
    return new Promise((resolve, reject) => {
      let reader = new FileReader();

      reader.onload = ()=> {
        return resolve(reader.result);
      };

      reader.readAsDataURL( file );
    });
  }

  static async uploadIncomingFiles(formData) {
    return new Promise((resolve, reject) => {
      axios
        .post(
          'http://localhost:4000/incomingfiles',
          formData
        )
        .then(response => {
          return resolve(response.data);
       })
       .catch(error => {
         return reject(error)
       });
    });
  }

  static async uploadServerFiles(data) {
    return new Promise((resolve, reject) => {
      axios
        .post(
          'http://localhost:4000/serverfiles', data, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }
        )
        .then(response => {
          return resolve(response.data);
       })
       .catch(error => {
         return reject(error)
       });
    });
  }

}
export default FileService;
