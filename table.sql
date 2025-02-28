CREATE DATABASE git_cheatsheet;

USE git_cheatsheet;

CREATE TABLE commands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL,
    command TEXT NOT NULL,
    status ENUM('pending', 'approved') DEFAULT 'pending'
);

INSERT INTO commands (description, command, status) VALUES 
('Clone a repository', 'git clone <repository-url>', 'approved'),
('Initialize a new repo', 'git init', 'approved'),
('Check status', 'git status', 'approved');


CREATE TABLE commands2 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL,
    command TEXT NOT NULL,
    status ENUM('pending', 'approved') DEFAULT 'pending'
);

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);
