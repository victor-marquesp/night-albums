-- sqlite

CREATE TABLE albums (

    id INTEGER PRIMARY KEY AUTOINCREMENT,

    name VARCHAR(120) NOT NULL,
    duration INTEGER NOT NULL CHECK(duration > 0),

    desc TEXT NULL CHECK(length(desc) < 1000),
    artist VARCHAR(120) NULL,
    genre VARCHAR(120) NULL 

);

CREATE TABLE experiences (

    id INTEGER PRIMARY KEY AUTOINCREMENT,
    album_id INTEGER,

    title VARCHAR(120) NOT NULL,
    mood VARCHAR(120) NOT NULL,
    stars FLOAT NOT NULL CHECK(stars >= 0 AND stars <= 5 ),

    desc TEXT NULL CHECK(length(desc) <= 10000),

    FOREIGN KEY (album_id) REFERENCES albums (id)
);
