-- This table holds information of all feedback.
CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    content TEXT,
    rating INT CHECK (rating BETWEEN 0 AND 5)
);
