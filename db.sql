-- -------------------------------------------------------
-- SQL for sample database
-- -------------------------------------------------------

CREATE DATABASE mathisi;

-- Auth System Users Table
CREATE TABLE mathisi.users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
-- Auth System Remeber Tokens Table
CREATE TABLE mathisi.remember_tokens (
    token_hash VARCHAR(64) PRIMARY KEY,
    user_id INT NOT NULL,
    expires_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id)
);