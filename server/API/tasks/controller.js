const sqlite3 = require('sqlite3').verbose();

function initDB() {
  const db = new sqlite3.Database('./db/tasks.db');
  db.serialize(function() {
    db.run("CREATE TABLE IF NOT EXISTS task (id INTEGER PRIMARY KEY AUTOINCREMENT, company VARCHAR, date DATE, status TEXT, platforms TEXT, imagePreviews TEXT, imageTypes TEXT)");
  });

  db.close();
}
initDB();

exports.taskUpload = (req, res) => {
  let company = req.body.body.company;
  let date = req.body.body.date;
  let status = req.body.body.message;
  let platforms = req.body.body.platforms;
  let imagePreviews = req.body.body.imagePreviews;
  let imageTypes = req.body.body.imageTypes;
  if (imagePreviews) {
    imagePreviews = imagePreviews.toString().replace(',', '|');
  }
  else { imagePreviews = null; }
  if (imageTypes) {
    imageTypes = imageTypes.toString().replace(',', '|');
  }
  else { imageTypes = null; }
  let params = [
    company,
    date,
    status.toString().replace(',', '|'),
    platforms.toString().replace(',', '|'),
    imagePreviews,
    imageTypes
  ];
  let response = "";
  const insertSQL = `
    INSERT INTO task (company, date, status, platforms, imagePreviews, imageTypes) VALUES ( @company, @date, @status, @platforms, @imagePreviews, @imageTypes)`;
  const getSQL = 'SELECT * FROM task ORDER BY id DESC';

  console.log('********* ADD TASK ON SERVER *********');
  console.log(req.body.body);

  let db = new sqlite3.Database('./db/tasks.db', sqlite3.OPEN_READWRITE, (err) => {
    if (err) {
      console.error(err.message);
    }
    console.log('******* Connected to the tasks database. *******');
  });

  db.run(insertSQL, params, function(err) {
    if (err) {
      response = err.message;
      return console.error(err.message);
    }
    response = `Rows inserted`;
    console.log(`** Rows inserted **`);
  });

  db.get(getSQL, (err, row) => {
    console.log(row);
  });

  db.close();

  res.json({response: response});
}

exports.getSchedule = (req, res) => {
  const getSQL = 'SELECT * FROM task ORDER BY date ASC';
  const alltasks = [];

  let db = new sqlite3.Database('./db/tasks.db', sqlite3.OPEN_READWRITE, (err) => {
    if (err) {
      res.send(err.message);
    }
  });
  db.all(getSQL, [], (err, rows) => {
    if (err) {
      res.send(err)
    }
    rows.forEach((row) => {
      alltasks.push(row);
    });
    res.json(alltasks)
  });
  db.close();
}
