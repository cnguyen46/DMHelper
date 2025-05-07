-- This table holds information of 4 players.
CREATE TABLE players (
    playerID INT AUTO_INCREMENT PRIMARY KEY,
    playerName VARCHAR(255) NOT NULL,
    className VARCHAR(50) NOT NULL,
    level INT NOT NULL DEFAULT 1 CHECK (level BETWEEN 1 AND 20),
    strength INT NOT NULL CHECK (strength BETWEEN 1 AND 30),
    dexterity INT NOT NULL CHECK (dexterity BETWEEN 1 AND 30),
    constitution INT NOT NULL CHECK (constitution BETWEEN 1 AND 30),
    intelligence INT NOT NULL CHECK (intelligence BETWEEN 1 AND 30),
    wisdom INT NOT NULL CHECK (wisdom BETWEEN 1 AND 30),
    charisma INT NOT NULL CHECK (charisma BETWEEN 1 AND 30)
);
