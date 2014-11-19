CREATE TABLE `galeriephotomvc`.`image` (
id int primary key AUTO_INCREMENT,
path varchar(1024),
category varchar(64),
comment varchar(1024)
); ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `galeriephotomvc`.`note` (
id int primary key AUTO_INCREMENT,
positive int,
negative int,
idImg int,
FOREIGN KEY (idImg) REFERENCES image(id)
); ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `galeriephotomvc`.`album` (
id int primary key AUTO_INCREMENT,
name varchar(64),
description varchar(1024),
img_enavant_id int
); ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `galeriephotomvc`.`appartient_album` (
album_id int ,
image_id int,
FOREIGN KEY (album_id) REFERENCES album(id),
FOREIGN KEY (image_id) REFERENCES image(id)
); ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
