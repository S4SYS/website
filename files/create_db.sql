DROP DATABASE if exists portal_lgpd;

CREATE DATABASE portal_lgpd;

USE portal_lgpd;

CREATE TABLE tipo_requisicao (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(128) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY(id)
)
ENGINE=INNODB;

CREATE TABLE setor (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(128) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY(id)
)
ENGINE=InnoDB;

CREATE TABLE requisicao (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  setor_id INTEGER UNSIGNED NOT NULL,
  tipo_requisicao_id INTEGER UNSIGNED NOT NULL,
  codigo VARCHAR(128) NULL,
  pedido TEXT NULL,
  cpf VARCHAR(32) NULL,
  telefone VARCHAR(32) NULL,
  email VARCHAR(64) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  PRIMARY KEY(id),
  INDEX requisicao_FKIndex1(tipo_requisicao_id),
  INDEX requisicao_FKIndex2(setor_id),
  FOREIGN KEY(tipo_requisicao_id)
    REFERENCES tipo_requisicao(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(setor_id)
    REFERENCES setor(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
)
ENGINE=InnoDB;





