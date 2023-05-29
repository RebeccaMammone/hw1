Create DATABASE hw1;
USE hw1:

CREATE TABLE users (
    username varchar(255) PRIMARY KEY,
    password varchar(255),
    email varchar(255),
    genere varchar(255) not null,
    sessualita varchar(255) not null,
) Engine = InnoDB;

CREATE TABLE incontri (
    id integer primary key auto_increment,
    user1 varchar(255),
    user2 varchar(255),
    index us(user1),
    index usr(user2),
    foreign key(user1) references users(username),
    foreign key(user2) references users(username) 
) Engine = InnoDB;