CREATE TABLE `phpmvcgallery`.`image` (
id int primary key AUTO_INCREMENT,
path varchar(1024),
name varchar(64),
category varchar(64),
comment varchar(1024)
);

CREATE TABLE `phpmvcgallery`.`votes` (
id int primary key AUTO_INCREMENT,
positive int,
negative int,
idImg int,
FOREIGN KEY (id) REFERENCES image(id)
);

CREATE TABLE `phpmvcgallery`.`album` (
id int primary key AUTO_INCREMENT,
name varchar(64),
description varchar(1024),
img_enavant_id int
);

CREATE TABLE `phpmvcgallery`.`partof_album` (
album_id int ,
image_id int,
FOREIGN KEY (album_id) REFERENCES album(id),
FOREIGN KEY (image_id) REFERENCES image(id)
);


ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
