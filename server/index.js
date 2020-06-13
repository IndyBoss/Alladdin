const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const app = express();
const port = 4000;
const taskChecker = require('./taskProcess/taskChecker.js');

app.use(cors());
app.use(express.urlencoded({ extended: true }));

const taskRoutes = require('./API/tasks/routes.js');
taskRoutes(app);

app.listen(port, () => console.log(`❗❗ Server listening on port ${port} ❗❗`));

taskChecker();
