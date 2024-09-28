const db = require('../config/db');
const multer = require('multer');
const path = require('path');

// Configure multer to save uploaded images to the public/images directory
const storage = multer.diskStorage({
    destination: (req, file, cb) => {
        cb(null, path.join(__dirname, '../public/images')); // Directory for storing images
    },
    filename: (req, file, cb) => {
        cb(null, file.originalname); // Save with original name
    }
});
const upload = multer({ storage: storage });

// Get all songs
exports.getAllSongs = async (req, res) => {
    return new Promise((resolve, reject) => {
        const query = 'SELECT * FROM songs';
        db.query(query, (err, results) => {
            if (err) {
                reject(err);
            } else {
                resolve(results);
            }
        });
    });
};

// Get song by ID and its lyrics
exports.getSongById = (req, res) => {
    const songId = req.params.id;
    const query = 'SELECT * FROM songs WHERE id = ?';
    db.query(query, [songId], (err, result) => {
        if (err) return res.status(500).send('Database query error');
        if (result.length === 0) {
            return res.status(404).send('Song not found');
        }
        res.json(result[0]);
    });
};

// Add a song with an image path
exports.addSong = (req, res) => {
    const { title, artist, album, genre, file_path, lyrics } = req.body;
    
    // Ensure file is uploaded
    if (!req.file) {
        return res.status(400).send('No image uploaded.');
    }
    
    const imagePath = `images/${req.file.filename}`; // Relative path to image

    const query = 'INSERT INTO songs (title, artist, album, genre, file_path, lyrics, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)';
    db.query(query, [title, artist, album, genre, file_path, lyrics, imagePath], (err, result) => {
        if (err) return res.status(500).send('Database insertion error');
        res.send('Song added successfully');
    });
};

// Increment play count
exports.incrementPlayCount = (req, res) => {
    const songId = req.params.id;
    const query = 'UPDATE songs SET play_count = play_count + 1 WHERE id = ?';
    db.query(query, [songId], (err, result) => {
        if (err) return res.status(500).send('Database update error');
        res.send('Play count updated successfully');
    });
};

// Export the multer upload middleware
exports.upload = upload.single('image'); // Use 'image' as the field name in the form


