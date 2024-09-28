const products = require('../models/ProductModel')

const rm={
    index:(req,res)=>{
        res.render('index')
    },
    save:(req,res)=>{
        const data = req.body;
        products.create(data,(err)=>{
            if(err) throw err;
            res.redirect('/');
        })
      
    }

};

module.exports = rm;