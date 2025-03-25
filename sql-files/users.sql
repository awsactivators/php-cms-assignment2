CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL
);


INSERT INTO users (username, email, password) VALUES
('John', 'john@email.ca', md5('testjohn')),
('Emily', 'emily@email.ca', md5('testemily')),
('Michael', 'michael@email.ca', md5('testmichael'));