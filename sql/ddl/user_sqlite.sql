--
-- Creating a User table.
--



--
-- Table User
--
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "acronym" TEXT UNIQUE NOT NULL,
    "email" TEXT,
    "password" TEXT,
    "created" TIMESTAMP,
    "updated" DATETIME,
    "deleted" DATETIME,
    "active" DATETIME
);

DROP TABLE IF EXISTS Posts;
CREATE TABLE Posts (
    "postId" INTEGER PRIMARY KEY NOT NULL,
    "userId" INTEGER,
    "rubrik" TEXT,
    "text" TEXT,
    "taggar" TEXT
);

DROP TABLE IF EXISTS Answers;
CREATE TABLE Answers (
    "answerId" INTEGER PRIMARY KEY NOT NULL,
    "id" INTEGER,
    "userId" INTEGER,
    "text" TEXT,
    FOREIGN KEY(id) REFERENCES Posts(postId)
);
