

CREATE DATABASE chimbilaDB;

CREATE TABLE Users (
user_id INT(6) UNSIGNED AUTO_INCREMENT,
first_name VARCHAR(30) NOT NULL,
last_name VARCHAR(30) NOT NULL,
display_name VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL,
password CHAR(41) NOT NULL,
PRIMARY KEY (user_id),
UNIQUE INDEX (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `Users` (`user_id`, `first_name`, `last_name`, `display_name`, `email`, `password`) VALUES
                        (1, 'Angel', 'Cruz', 'Angel', 'aacruz@unillanos.edu.co', 'eikon666'),
                        (2, 'Francisco', 'Sanchez', 'Pacho', 'fsanchezbarrera@unillanos.edu.co', 'pacho321');



CREATE USER 'chimbilaDBUser'@'localhost' IDENTIFIED BY 'Ch1mb1';

GRANT ALL PRIVILEGES ON chimbilaDB . * TO 'chimbilaDBUser'@'localhost';