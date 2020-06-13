import axios from 'axios';

class LocalTaskStorage {
  static tasks=[]

  static addMessageTask(company, date, message, platforms , imagePreviews, imageTypes) {
    const messageTask = {
      id: 'task',
      message,
      imagePreviews,
      imageTypes,
      platforms,
      date,
      company
    };
    LocalTaskStorage.tasks.push(messageTask)
  }

  static getTasks() {
    return LocalTaskStorage.tasks;
  }

  static clearTasks() {
    LocalTaskStorage.tasks = [];
  }

  static getCurrentTask () {
    return LocalTaskStorage.tasks.pop();
  }

}
export default LocalTaskStorage;
