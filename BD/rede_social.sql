CREATE DATABASE rede_social;

-- -----------------------------------------------------
-- Table `rede_social`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rede_social`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `sobrenome` VARCHAR(80) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(80) NOT NULL,
  `aniversario` DATE NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rede_social`.`chat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rede_social`.`chat` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `mensagem_chat` LONGTEXT NULL,
  `imagem_chat` LONGBLOB NULL,
  `usuario_send` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  INDEX `fk_chat_usuario1_idx` (`usuario_id` ASC) ,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_chat_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `rede_social`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rede_social`.`feed`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rede_social`.`feed` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `mensagem_feed` LONGTEXT NULL,
  `imagem_feed` LONGBLOB NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_feed_usuario1_idx` (`usuario_id` ASC) ,
  CONSTRAINT `fk_feed_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `rede_social`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rede_social`.`perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rede_social`.`perfil` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `imagens` LONGBLOB NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_perfil_usuario1_idx` (`usuario_id` ASC) ,
  CONSTRAINT `fk_perfil_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `rede_social`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

