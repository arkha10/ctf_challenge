const express = require('express');
const fs = require('fs');
const path = require('path');
const uploadHandler = require('./upload');

const app = express();
const PORT = 4000;

if (!fs.existsSync('./uploads')) {
    fs.mkdirSync('./uploads');
}
app.disable('etag');
app.use(express.static('public'));
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.use((req, res, next) => {
    if ([req.body, req.headers, req.query].some(
        (item) => item && JSON.stringify(item).includes("flag")
    )) {
        return res.send("kamu bukan atmint!");
    }
    next();
});

app.post('/upload', uploadHandler);

app.get('/read', (req, res) => {
    try {
        res.setHeader("Content-Type", "text/plain");
        res.send(fs.readFileSync(req.query.nama_file).toString());
    } catch (err) {
        console.log(err);
        if (err.code === 'ENOENT') {
            res.status(404).send('File tidak ada');
        } else if (err.code === 'EACCES') {
            res.status(403).send('Akses ditolak');
        } else {
            res.status(500).send('Erroasr');
        }
    }
});

app.listen(PORT, '0.0.0.0', () => {
    console.log(`Server running on port ${PORT}`);
});