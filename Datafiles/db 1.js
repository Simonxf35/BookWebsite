npm install
node app.js
Execute Node.js

const mysql = require('mysql2');

// Create a connection pool
const pool = mysql.createPool({
  host: 'localhost',
  user: 'your_username',
  password: 'your_password',
  database: 'library_db',
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0,
});

// Export the pool to be used in other modules
module.exports = pool.promise();

