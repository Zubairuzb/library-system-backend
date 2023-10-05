CREATE DATABASE `library_system`;

USE `library_system`;

CREATE TABLE `user`(
    `user_id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `fullname` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `gender` ENUM('Male', 'Female') NOT NULL,
    `level` INT(11) NOT NULL,
     UNIQUE(email)
);


CREATE TABLE `admin`(
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
)


CREATE TABLE `book`(
    `book_id` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `author` VARCHAR(255) NOT NULL,
    `isbn` VARCHAR(255) NOT NULL,
    `year` INT(11) NOT NULL,
    `status` ENUM('Available', 'Not-Available') NOT NULL,
    `request` BOOLEAN DEFAULT 0 NOT NULL,
    UNIQUE(isbn)
)

CREATE TABLE `borrowed_books` (
    borrowed_id INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    borrow_date DATE,
    return_date DATE,
    user_id INT,
    book_id INT,
    FOREIGN KEY(user_id) REFERENCES user(user_id),
    FOREIGN KEY(book_id) REFERENCES book(book_id)
)


CREATE TABLE `requests` (
    requests_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    status ENUM('pending', 'approved', 'denied') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(user_id),
    FOREIGN KEY (book_id) REFERENCES book(book_id)
);