create database IPLscore;
use IPLscore;

CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(30) NOT NULL
);

CREATE TABLE players (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    player_name VARCHAR(255) NOT NULL,
    runs_scored INT(11) NOT NULL,
    balls_faced INT(11) NOT NULL
);

Insert into users values('1','Prateek','Prateek@123');

select * from users;
select * from players;