--
-- File generated with SQLiteStudio v3.2.1 on Wed Dec 11 02:42:01 2019
--
-- Text encoding used: System
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: User
CREATE TABLE User (id INTEGER PRIMARY KEY NOT NULL, acronym TEXT UNIQUE NOT NULL, password TEXT, created TIMESTAMP, updated DATETIME, deleted DATETIME, active DATETIME);

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
