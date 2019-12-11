CREATE SCHEMA 'wimc' ;

CREATE TABLE `wimc`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE);

CREATE TABLE `wimc`.`locations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `latitude` DECIMAL(10,8) NOT NULL,
  `longitude` DECIMAL(11,8) NOT NULL,
  `date` DATETIME NULL,
  PRIMARY KEY (`id`));

ALTER TABLE `wimc`.`locations` 
ADD COLUMN `userId` INT NOT NULL AFTER `date`,
ADD INDEX `userId_idx` (`userId` ASC) VISIBLE;
;
ALTER TABLE `wimc`.`locations` 
ADD CONSTRAINT `locationUserId`
FOREIGN KEY (`userId`)
REFERENCES `wimc`.`users` (`id`)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
