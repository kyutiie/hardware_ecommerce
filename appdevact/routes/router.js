const express=require('express');
const router = express.Router();
const rm =require('../controller/RmController');
router.get('/',rm.index );
router.post('/save',rm.save );


module.exports = router;