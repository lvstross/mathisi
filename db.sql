-- -------------------------------------------------------
-- SQL for sample database
-- -------------------------------------------------------

CREATE DATABASE mvc;

-- Default App Table
CREATE TABLE mvc.posts (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(128) NOT NULL,
    content TEXT NOT NULL,
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);
-- Auth System Users Table
CREATE TABLE mvc.users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
-- Auth System Remeber Tokens Table
CREATE TABLE mvc.remember_tokens (
    token_hash VARCHAR(64) PRIMARY KEY,
    user_id INT NOT NULL,
    expires_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

--
-- Sample data
--

INSERT INTO mvc.posts (title, content) VALUES
('Cats Are Awesome', 'This post is all about why cats are amazing animals.'),
('Dogs Are Awesome', 'This post is all about why dogs are so great.'),
('Shark Week', 'Let me just tell you about the sharks this week.');