CREATE DATABASE IF NOT EXISTS novel_db;
USE novel_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

CREATE TABLE novels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(50) NOT NULL
);

CREATE TABLE rahasia (
    nama VARCHAR(100) NOT NULL,
    isi TEXT NOT NULL,
    keterangan VARCHAR(100) NOT NULL
);

INSERT INTO users (username, password) VALUES
('admin', 'weakpassword123'),
('user1', 'password1'),
('test', 'test123');

INSERT INTO novels (title, content, author) VALUES
('Petualangan Sherlock', 'Sherlock Holmes menyelesaikan misteri pembunuhan di Baker Street dengan deduksi logis yang brilian.', 'Arthur Conan Doyle'),
('Harry Potter', 'Petualangan Harry Potter di Hogwarts melawan Voldemort yang penuh dengan sihir dan persahabatan.', 'J.K. Rowling'),
('Laskar Pelangi', 'Kisah persahabatan anak-anak di Belitung yang penuh semangat belajar meski dalam keterbatasan.', 'Andrea Hirata'),
('Bumi Manusia', 'Kisah cinta dan perjuangan Minke dalam masa kolonial yang penuh dengan nilai-nilai kemanusiaan.', 'Pramoedya Ananta Toer'),
('Dilan 1990', 'Kisah cinta masa SMA Dilan dan Milea yang romantis dan penuh kenangan indah.', 'Pidi Baiq');

INSERT INTO rahasia (nama, isi, keterangan) VALUES
('Flag', 'NCU{Y0u_c4n_alS0_trY_wiTh_sqlmap}', 'kamu berhasil');


ALTER TABLE novels ADD COLUMN genre VARCHAR(50) AFTER author;

UPDATE novels SET genre = 'Mystery' WHERE title = 'Petualangan Sherlock';
UPDATE novels SET genre = 'Fantasy' WHERE title = 'Harry Potter';
UPDATE novels SET genre = 'Drama' WHERE title = 'Laskar Pelangi';
UPDATE novels SET genre = 'Historical' WHERE title = 'Bumi Manusia';
UPDATE novels SET genre = 'Romance' WHERE title = 'Dilan 1990';

INSERT INTO novels (title, content, author, genre) VALUES
('The Shining', 'Seorang penulis dan keluarganya menjadi penjaga hotel terpencil di musim dingin, namun hotel tersebut menyimpan rawa mengerikan.', 'Stephen King', 'Horror'),
('Dune', 'Petualangan Paul Atreides di planet padang pasir Arrakis yang penuh dengan politik, agama, dan rempah-rempah.', 'Frank Herbert', 'Sci-Fi'),
('The Godfather', 'Kisah keluarga mafia Corleone dan perjuangan Michael Corleone dalam dunia kejahatan terorganisir.', 'Mario Puzo', 'Crime'),
('Pride and Prejudice', 'Kisah cinta Elizabeth Bennet dan Mr. Darcy dalam masyarakat Inggris abad ke-19 yang penuh dengan prasangka dan kelas sosial.', 'Jane Austen', 'Classic'),
('The Hobbit', 'Petualangan Bilbo Baggins bersama para kurcaci untuk merebut kembali harta mereka dari naga Smaug.', 'J.R.R. Tolkien', 'Adventure');