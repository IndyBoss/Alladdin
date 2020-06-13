import axios from 'axios';

class ServerTaskStorage {
  static addServerTask(company, date, message, platforms , imagePreviews, imageTypes) {
    const serverTask = {
      id: 'task',
      message,
      imagePreviews,
      imageTypes,
      platforms,
      date,
      company
    };
    axios
      .post("http://localhost:4000/uploadTask", {
        method: "POST",
        headers: {
          "content-type": "multipart/form-data",
          'Accept': 'multipart/form-data'
        },
        body: serverTask
      })
      .then(response => {
        return response;
     })
     .catch(error => {
       return error
     });
  }

}
export default ServerTaskStorage;
