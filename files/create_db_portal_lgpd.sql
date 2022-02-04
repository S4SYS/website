DROP DATABASE if EXISTS `portal_lgpd`;

CREATE DATABASE IF NOT EXISTS `portal_lgpd`;
USE `portal_lgpd`;

CREATE TABLE IF NOT EXISTS `setor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `tipo_requisicao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `status` (
  `id` int(10) unsigned NOT NULL,
  `nome` varchar(128) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `requisicao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setor_id` int(10) unsigned NOT NULL,
  `tipo_requisicao_id` int(10) unsigned NOT NULL,
  `status_id` int(10) unsigned NOT NULL DEFAULT 1,
  `codigo` varchar(128) DEFAULT NULL,
  `pedido` text DEFAULT NULL,
  `nome` varchar(128) NOT NULL,
  `cpf` varchar(32) DEFAULT NULL,
  `telefone` varchar(32) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `arquivo` varchar(128) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `requisicao_FKIndex1` (`tipo_requisicao_id`),
  KEY `requisicao_FKIndex2` (`setor_id`),
  KEY `requisicao_FKIndex3` (`status_id`),
  CONSTRAINT `requisicao_ibfk_1` FOREIGN KEY (`tipo_requisicao_id`) REFERENCES `tipo_requisicao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `requisicao_ibfk_2` FOREIGN KEY (`setor_id`) REFERENCES `setor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `requisicao_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE violacao (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `status_id` int(10) unsigned NOT NULL DEFAULT 1,
  codigo VARCHAR(128) NULL,
  cpf varchar(32) DEFAULT NULL,
  `nome` varchar(128) NOT NULL,
  telefone varchar(32) DEFAULT NULL,
  email varchar(64) DEFAULT NULL,  
  descricao TEXT NULL,
  `arquivo` varchar(128) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT current_timestamp(),
  updated_at TIMESTAMP NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY(id),
  KEY `violacao_FKIndex1` (`status_id`),
  CONSTRAINT `violacao_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO setor(nome) VALUES('Administrativo');
INSERT INTO setor(nome) VALUES('Financeiro');
INSERT INTO setor(nome) VALUES('Comercial');
INSERT INTO setor(nome) VALUES('Gente e Gestão');
INSERT INTO setor(nome) VALUES('Jurídico');
INSERT INTO setor(nome) VALUES('Marketing');
INSERT INTO setor(nome) VALUES('Tecnologia');

INSERT INTO tipo_requisicao(nome) VALUES('Confirmar a existência de tratamento com meus dados pessoais');
INSERT INTO tipo_requisicao(nome) VALUES('Ter acesso aos meus dados pessoais que estão sendo tratados');
INSERT INTO tipo_requisicao(nome) VALUES('Corrigir algum dado pessoal incompleto, inexato ou desatualizado');
INSERT INTO tipo_requisicao(nome) VALUES('Anonimizar, bloquear ou eliminar algum dado pessoal');
INSERT INTO tipo_requisicao(nome) VALUES('Realizar a portabilidade dos meus dados pessoais a outro fornecedor de serviço/produto');
INSERT INTO tipo_requisicao(nome) VALUES('Eliminar dados pessoais com o meu consentimento');
INSERT INTO tipo_requisicao(nome) VALUES('Ser informado sobre as entidades públicas e privadas com as quais a S4Sys compartilha meus dados pessoais');
INSERT INTO tipo_requisicao(nome) VALUES('Ser informado sobre a possibilidade de não fornecer consentimento sobre as consequências da negativa');
INSERT INTO tipo_requisicao(nome) VALUES('Revogar o consentimento que forneci para alguma operação de tratamento com meus dados pessoais');

INSERT INTO status(id, nome) VALUES(1, 'Em análise');