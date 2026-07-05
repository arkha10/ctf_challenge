const multer = require('multer');
const crypto = require('crypto');
const path = require('path');

const storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, './uploads/');
    },
    filename: function (req, file, cb) {
        const randomName = crypto.randomBytes(16).toString('hex');
        cb(null, randomName + '.txt');
    }
});

const fileFilter = (req, file, cb) => {
    const ext = path.extname(file.originalname).toLowerCase();
    if (ext !== '.txt') {
        return cb(new Error('Only .txt files are allowed'), false);
    }
    cb(null, true);
};

const upload = multer({
    storage: storage,
    fileFilter: fileFilter,
    limits: {
        fileSize: 100 * 1024
    }
}).single('file');

module.exports = (req, res) => {
    upload(req, res, function(err) {
        if (err instanceof multer.MulterError) {
            if (err.code === 'LIMIT_FILE_SIZE') {
                return res.status(400).send('File size exceeds 100KB limit');
            }
            return res.status(400).send('Upload error: ' + err.message);
        } else if (err) {
            return res.status(400).send(err.message);
        }

        if (!req.file) {
            return res.status(400).send('No file uploaded');
        }

        res.send(`File uploaded successfully: ${req.file.filename}`);
    });
};