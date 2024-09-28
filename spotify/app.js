const express = require('express');
const bodyParser = require('body-parser');
const songRoutes = require('./routes/songRoutes');
const playlistRoutes = require('./routes/playlistRoutes');
const songController = require('./controllers/songController'); // Import your song controller
const path = require('path');
const app = express();

app.set('view engine', 'ejs');
app.use(express.static(path.join(__dirname, 'public')));

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

app.use('/songs', songRoutes);
app.use('/playlists', playlistRoutes);

app.get('/', (req, res) => {
    songController.getAllSongs()
        .then(songs => {
            res.render('index', { songs }); // Pass songs to the template
        })
        .catch(err => {
            console.error(err);
            res.render('index', { songs: [] }); // Pass an empty array in case of error
        });
});

app.post('/play-song/:id', songController.incrementPlayCount);
app.listen(2090, () => {
    console.log(`Server is running on http://localhost:2090`);
});
