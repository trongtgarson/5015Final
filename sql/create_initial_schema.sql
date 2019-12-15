use FA10_5015_tua20258;

CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC));

CREATE TABLE `locations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `latitude` DECIMAL(10,8) NOT NULL,
  `longitude` DECIMAL(11,8) NOT NULL,
  `date` DATETIME NULL,
  PRIMARY KEY (`id`));

ALTER TABLE `locations`
ADD COLUMN `userId` INT NOT NULL AFTER `date`,
ADD INDEX `userId_idx` (`userId` ASC);
;
ALTER TABLE `locations`
ADD CONSTRAINT `locationUserId`
FOREIGN KEY (`userId`)
REFERENCES `users` (`id`)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
