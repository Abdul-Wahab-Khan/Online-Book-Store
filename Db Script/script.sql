CREATE DATABASE IF NOT EXISTS `online_book_store`;
USE `online_book_store`;

CREATE TABLE IF NOT EXISTS `register_user` (
  `register_user_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `user_name` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `user_activation_code` varchar(250) NOT NULL,
  `user_email_status` enum('not verified','verified') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2;

CREATE TABLE IF NOT EXISTS `Book` (
    `book_id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(250) NOT NULL,
    `description` varchar(500),
    `price` int default 0
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Borrowed_Book` (
    `book_id` int,
    `register_user_id` int,
    `borrowed_date` date NOT NULL,
    `date_to_return` date,
    FOREIGN KEY (book_id) REFERENCES Book(book_id),
    FOREIGN KEY (register_user_id) REFERENCES register_user(register_user_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Uploaded_Book` (
    `book_id` int,
    `register_user_id` int,
    `upload_date` date NOT NULL,
    FOREIGN KEY (book_id) REFERENCES Book(book_id),
    FOREIGN KEY (register_user_id) REFERENCES register_user(register_user_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Downloaded_Book` (
    `book_id` int,
    `register_user_id` int,
    `download_date` date NOT NULL,
    `paid` int default 0,
    FOREIGN KEY (book_id) REFERENCES Book(book_id),
    FOREIGN KEY (register_user_id) REFERENCES register_user(register_user_id)
) ENGINE=InnoDB;

