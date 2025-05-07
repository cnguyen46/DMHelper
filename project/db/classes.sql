-- This table holds information of all classes.
CREATE TABLE classes (
    classId INT AUTO_INCREMENT PRIMARY KEY,
    className VARCHAR(50) NOT NULL UNIQUE,
    strength INT NOT NULL CHECK (strength BETWEEN 1 AND 30),
    dexterity INT NOT NULL CHECK (dexterity BETWEEN 1 AND 30),
    constitution INT NOT NULL CHECK (constitution BETWEEN 1 AND 30),
    intelligence INT NOT NULL CHECK (intelligence BETWEEN 1 AND 30),
    wisdom INT NOT NULL CHECK (wisdom BETWEEN 1 AND 30),
    charisma INT NOT NULL CHECK (charisma BETWEEN 1 AND 30)
);

--Insert data
INSERT INTO classes (className, strength, dexterity, constitution, intelligence, wisdom, charisma) VALUES
('Cleric', 15, 10, 13, 8, 17, 12),
('Mage', 8, 13, 15, 17, 10, 12),
('Ranger', 12, 17, 13, 8, 15, 10),
('Rogue', 8, 17, 14, 13, 13, 10),
('Warrior', 17, 13, 15, 10, 12, 8);