const db = require('../config/db');

const prod = {
    create:(data,callback) =>{
        const query = "insert intoproducts (name, description, price, quantity) values(?,?,?,?)";
        db.query(query,[data.name, data.description, data.price, data.quantity ],callback);
    }
};
module.exports =prod;