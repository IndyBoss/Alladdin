module.exports = (app) => {
  const taskController = require('./controller.js');

  app.route('/uploadTask').post(taskController.taskUpload);
  app.route('/getschedule').get(taskController.getSchedule);
}
