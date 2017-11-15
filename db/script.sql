CREATE SCHEMA `jerrejerre` ;
CREATE TABLE `jerrejerre`.`clientes` (
  `idclientes` INT NOT NULL AUTO_INCREMENT,
  `Email` VARCHAR(255) NOT NULL,
  `Nombre` VARCHAR(64) NULL,
  `Apellido` VARCHAR(64) NULL,
  `Codigo` INT NOT NULL,
  PRIMARY KEY (`idclientes`));