const db = require('../config/db');

exports.getAllPlaylists = (req, res) => {
    const query = 'SELECT * FROM playlists';
    db.query(query, (err, results) => {
        if (err) throw err;
        res.json(results);
    });
};

exports.addPlaylist = (req, res) => {
    const { name, song_ids } = req.body;
    const query = 'INSERT INTO playlists (name, song_ids) VALUES (?, ?)';
    db.query(query, [name, song_ids], (err, result) => {
        if (err) throw err;
        res.send('Playlist created successfully');
    });
};
