const express = require('express');
const router = express.Router();
const playlistController = require('../controllers/playlistController'); // Ensure this path is correct


router.get('/', playlistController.getAllPlaylists); // Ensure getAllPlaylists is defined
router.post('/', playlistController.addPlaylist); // Ensure addPlaylist is defined

module.exports = router;

