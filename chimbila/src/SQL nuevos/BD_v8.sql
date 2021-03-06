-- MySQL Script generated by Yerfer
-- Jueves 19/04/2018 9:40 am
-- Model: New Model    Version: 1.0


SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema chimbiladb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `chimbiladb` ;

-- -----------------------------------------------------
-- Schema chimbiladb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `chimbiladb` DEFAULT CHARACTER SET utf8 ;
USE `chimbiladb` ;

-- -----------------------------------------------------
-- Table `chimbiladb`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chimbiladb`.`usuario` ;

CREATE TABLE IF NOT EXISTS `chimbiladb`.`usuario` (
  `id` INT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(30) NOT NULL,
  `apellido` VARCHAR(30) NOT NULL,
  `nickname` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` CHAR(41) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email` (`email` ASC),
  UNIQUE INDEX `nickname_UNIQUE` (`nickname` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `chimbiladb`.`audio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chimbiladb`.`audio` ;

CREATE TABLE IF NOT EXISTS `chimbiladb`.`audio` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre_original` VARCHAR(45) NOT NULL,
  `nombre_audio` VARCHAR(45) NOT NULL,
  `ruta` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `chimbiladb`.`tipo_etiqueta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chimbiladb`.`tipo_etiqueta` ;

CREATE TABLE IF NOT EXISTS `chimbiladb`.`tipo_etiqueta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `chimbiladb`.`etiqueta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chimbiladb`.`etiqueta` ;

CREATE TABLE IF NOT EXISTS `chimbiladb`.`etiqueta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo_etiqueta_id` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `tipo_etiqueta_id`),
  CONSTRAINT `fk_etiqueta_tipo_etiqueta`
    FOREIGN KEY (`tipo_etiqueta_id`)
    REFERENCES `chimbiladb`.`tipo_etiqueta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `chimbiladb`.`anotacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chimbiladb`.`anotacion` ;

CREATE TABLE IF NOT EXISTS `chimbiladb`.`anotacion` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(6) UNSIGNED NOT NULL,
  `audio_id` INT(11) NOT NULL,
  `etiqueta_id` INT(11) NOT NULL,
  `tiempo_ini` TIME(5) NULL DEFAULT NULL,
  `tiempo_fin` TIME(5) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `usuario_id`, `audio_id`, `etiqueta_id`),
  CONSTRAINT `fk_anotacion_usuario`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `chimbiladb`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anotacion_audio`
    FOREIGN KEY (`audio_id`)
    REFERENCES `chimbiladb`.`audio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anotacion_etiqueta`
    FOREIGN KEY (`etiqueta_id`)
    REFERENCES `chimbiladb`.`etiqueta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `chimbiladb`.`jerarquia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chimbiladb`.`jerarquia` ;
-- Es como si fuera una fk apuntanto a si misma, la jerarquia root apunta a null, por eso es nullable.
CREATE TABLE IF NOT EXISTS `chimbiladb`.`jerarquia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre_coleccion` VARCHAR(150) NOT NULL,
  `antecesor_id` INT NULL,  
  `usuario_id` INT(6) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `usuario_id`),
  CONSTRAINT `fk_jerarquia_usuario`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `chimbiladb`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `chimbiladb`.`tipo_estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chimbiladb`.`tipo_estado` ;

CREATE TABLE IF NOT EXISTS `chimbiladb`.`tipo_estado` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_estado` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(250) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chimbiladb`.`coleccion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chimbiladb`.`coleccion` ;

CREATE TABLE IF NOT EXISTS `chimbiladb`.`coleccion` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `audio_id` INT(11) NOT NULL,
  `jerarquia_id` INT(11) NOT NULL,
  `jerarquia_usuario_id` INT(6) UNSIGNED NOT NULL,
  `tipo_estado_id` INT NOT NULL,
  PRIMARY KEY (`id`, `audio_id`, `jerarquia_id`, `jerarquia_usuario_id`, `tipo_estado_id`),
  CONSTRAINT `fk_coleccion_audio`
    FOREIGN KEY (`audio_id`)
    REFERENCES `chimbiladb`.`audio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_coleccion_jerarquia`
    FOREIGN KEY (`jerarquia_id`)
    REFERENCES `chimbiladb`.`jerarquia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_coleccion_jerarquia_usuario`
    FOREIGN KEY (`jerarquia_usuario_id`)
    REFERENCES `chimbiladb`.`jerarquia` (`usuario_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_coleccion_tipo_estado`
    FOREIGN KEY (`tipo_estado_id`)
    REFERENCES `chimbiladb`.`tipo_estado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
