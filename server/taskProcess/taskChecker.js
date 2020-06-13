const sqlite3 = require('sqlite3').verbose();
const fs  = require('fs');

function init() {
  const POLLING_INTERVAL = 5 * 10000;
  const checkForTasks = () => {
    const getSQL = 'SELECT * FROM task ORDER BY date ASC';
    const d = new Date()
    const today = new Date(d.getFullYear(), d.getMonth(), d.getDate());

    let db = new sqlite3.Database('./db/tasks.db', sqlite3.OPEN_READWRITE, (err) => {
      if (err) {
        console.log(err.message);
      }
    });

    db.get(getSQL, (err, task) => {
      if(task) {
        const someday = new Date(task.date.split("-"));
        if (today >= someday) {
          processTask(task);
          const delSQL = 'DELETE FROM task WHERE id =' + task.id;
          db.run(delSQL, function(err) {
            if (err) {
              console.log(err.message);
            } else {
              console.log(`Task removed from DB`);
            }
          });
        }
      }
    });

    db.close();
  }
  const interval = setInterval(checkForTasks, POLLING_INTERVAL);
}
module.exports = init;



const processTask = async(task) => {
  task.platforms = task.platforms.toString().split("|");
  task.imagePreviews = task.imagePreviews.toString().split("|");
  task.imageTypes = task.imageTypes.toString().split("|");
  console.log('Task processing');
  const promises = task.platforms.map(async (platform) => {

  })

  const p = await Promise.all(promises)
  return p;
}
