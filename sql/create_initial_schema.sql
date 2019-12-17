use FA10_5015_tua20258;

CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(100) BINARY NOT NULL,
  `contactName` NVARCHAR(255) NOT NULL,
  `activationCode` VARCHAR(8) NOT NULL,
  `activatedAt` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC));


CREATE TABLE `locations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `latitude` DECIMAL(10,8) NOT NULL,
  `longitude` DECIMAL(11,8) NOT NULL, 
  `date` DATETIME NULL,
  `userId` INT NOT NULL, 
  PRIMARY KEY (`id`), 
  CONSTRAINT `locationsUserId`
  FOREIGN KEY (`userId`)
  REFERENCES `users` (`id`)
  ON DELETE CASCADE         
  ON UPDATE NO ACTION);  
