CREATE DATABASE registerformtask;

USE registerformtask;

CREATE TABLE users (
    id int(8) PRIMARY KEY AUTO_INCREMENT, 
    name varchar(32), 
    email varchar(32) UNIQUE, 
    password varchar(32));

