CREATE TABLE `User`(
  `Id` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(32) NOT NULL ,
  `Password` VARCHAR(256) NOT NULL ,
  `Salt` VARCHAR(256) NOT NULL ,
  `Status` INT NOT NULL ,
  PRIMARY KEY (`Id`)
);
  
CREATE TABLE `Code` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `UserId` INT,
  `Title` VARCHAR(32),
  `Language` VARCHAR(32),
  `CODE` TEXT NOT NULL,
   PRIMARY KEY (`Id`)
);


