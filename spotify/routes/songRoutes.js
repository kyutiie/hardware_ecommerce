const express = require('express');
const router = express.Router();
const songController = require('../controllers/songController.js');

router.get('/', songController.getAllSongs);
router.get('/:id', songController.getSongById);
router.post('/', songController.upload, songController.addSong);
router.put('/:id/play', songController.incrementPlayCount); 
router.put('/', songController.incrementPlayCount); 


module.exports = router;

