const mysql = require('mysql2')

const db = mysql.createConnection({
    host:'localhost',
    user:'rm',
    password:'rmrmrm',
    database:'ep'
});

db.connect((err)=>{
    if(err) throw err;
    console.log('Connected to MySQL Database.');

});

module.exports =db