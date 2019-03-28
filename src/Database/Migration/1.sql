CREATE DATABASE cars;
USE cars;
CREATE TABLE car
(
  id       INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  color     varchar(10)  NOT NULL DEFAULT 'normal',
  brand     VARCHAR(10)  NOT NULL,
  seats     INT UNSIGNED NOT NULL

) ENGINE InnoDB;