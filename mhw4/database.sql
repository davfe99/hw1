CREATE DATABASE mhw4;

use mhw4;

create table users (
     username varchar(15),
     password varchar(16),
     email varchar(45),
     user_id int auto_increment primary key
) engine = 'innodb';

INSERT INTO users(username, password, email) VALUES('davife99', 'Scuola-00','davide@gmail.com');
INSERT INTO posts(post_id, user_id, likes, content) VALUES("1", "3","88", JSON_OBJECT('url','https://apod.nasa.gov/apod/image/2205/RCW86_MP1024.jpg','comment','suca doppia')
);
create table posts (
     post_id int auto_increment primary key,
     user_id int NOT NULL,
     likes int,
     content JSON,
     FOREIGN KEY (user_id) REFERENCES users(user_id) on delete cascade on update cascade
) engine = 'innodb';     

/* necessaria per impedire ad un utente di mettere più like a post uguali, 
   quella determinata coppia può esistere solo una volta */
CREATE TABLE likes (
    user_id integer not null,
    post_id integer not null,
/*        nome index          */
    index x_user(user_id),
    index x_post(post_id),
    foreign key(user_id) references users(user_id) on delete cascade on update cascade,
    foreign key(post_id) references posts(post_id) on delete cascade on update cascade,
    primary key(user_id, post_id)
) Engine = InnoDB;

DELIMITER //
CREATE TRIGGER likes_trigger
AFTER INSERT ON likes
FOR EACH ROW
BEGIN
UPDATE posts 
SET likes = likes + 1
WHERE post_id = new.post_id;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER unlikes_trigger
AFTER DELETE ON likes
FOR EACH ROW
BEGIN
UPDATE posts 
SET likes = likes - 1
WHERE post_id = old.post_id;
END //
DELIMITER ;