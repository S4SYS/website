DROP DATABASE if EXISTS `portal_lgpd`;

CREATE DATABASE IF NOT EXISTS `portal_lgpd`;
USE `portal_lgpd`;

CREATE TABLE IF NOT EXISTS cliente (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(128) NULL,
  dominio VARCHAR(128) NOT NULL,
  token VARCHAR(64) NOT NULL,
  ultimo_acesso TIMESTAMP NULL,
  ativo BOOLEAN DEFAULT TRUE,
  created_at TIMESTAMP DEFAULT current_timestamp(),
  updated_at TIMESTAMP DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;


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
  cliente_id int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `requisicao_FKIndex1` (`cliente_id`),
  CONSTRAINT `requisicao_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `requisicao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setor_id` int(10) unsigned NOT NULL,
  `tipo_requisicao_id` int(10) unsigned NOT NULL,
  `status_id` int(10) unsigned NOT NULL DEFAULT 1,
   cliente_id int(10) UNSIGNED NOT NULL,
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
  KEY `requisicao_FKIndex4` (`cliente_id`),
  CONSTRAINT `requisicao_ibfk_1` FOREIGN KEY (`tipo_requisicao_id`) REFERENCES `tipo_requisicao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `requisicao_ibfk_2` FOREIGN KEY (`setor_id`) REFERENCES `setor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `requisicao_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `requisicao_ibfk_4` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;       

CREATE TABLE violacao (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `status_id` int(10) unsigned NOT NULL DEFAULT 1,
  cliente_id int(10) UNSIGNED NOT NULL,
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
  KEY `violacao_FKIndex2` (`cliente_id`),
  CONSTRAINT `violacao_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `violacao_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

CREATE TABLE usuario (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(128) NOT NULL,
  login VARCHAR(64) NOT NULL,
  senha VARCHAR(128) NOT NULL,  
  last_login TIMESTAMP NULL,
  ativo BOOLEAN NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE acao (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(64) NOT NULL,
  descricao TEXT NULL,
  ativo BOOLEAN NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE usuario_acao (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  usuario_id INTEGER UNSIGNED NOT NULL,
  acao_id INTEGER UNSIGNED NOT NULL,
  descricao TEXT NULL,
  comentario TEXT NULL,
  tabela VARCHAR(64) NULL,  
  atual_id INTEGER UNSIGNED NULL,
  anterior_id INTEGER UNSIGNED NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY(id),
  INDEX usuario_acao_FKIndex1(usuario_id),
  INDEX usuario_acao_FKIndex2(acao_id),
  FOREIGN KEY(usuario_id)
    REFERENCES usuario(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(acao_id)
    REFERENCES acao(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE requisicao_usuario_acao (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  requisicao_id INTEGER UNSIGNED NOT NULL,
  usuario_acao_id INTEGER UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY(id),
  INDEX requisicao_has_usuario_acao_FKIndex1(requisicao_id),
  INDEX requisicao_has_usuario_acao_FKIndex2(usuario_acao_id),
  FOREIGN KEY(requisicao_id)
    REFERENCES requisicao(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(usuario_acao_id)
    REFERENCES usuario_acao(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE violacao_usuario_acao (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  violacao_id INTEGER UNSIGNED NOT NULL,
  usuario_acao_id INTEGER UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY(id),
  INDEX requisicao_has_usuario_acao_FKIndex1(violacao_id),
  INDEX requisicao_has_usuario_acao_FKIndex2(usuario_acao_id),
  FOREIGN KEY(violacao_id)
    REFERENCES violacao(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(usuario_acao_id)
    REFERENCES usuario_acao(id)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
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

INSERT INTO usuario (nome, login, senha) VALUES ('Administrador S4SYS', 'admin', SHA1('admin'));

INSERT INTO acao(nome, descricao) VALUES ('create', 'Criar');
INSERT INTO acao(nome, descricao) VALUES ('update', 'Atualizar');
INSERT INTO acao(nome, descricao) VALUES ('deactivate', 'Desativar');
INSERT INTO acao(nome, descricao) VALUES ('delete', 'Deletar');

INSERT INTO cliente(nome, dominio, token) 
VALUES ('Site S4sys', 's4sys.com.br', TO_BASE64(SHA1(CONCAT('Site S4sys', NOW())))),
('Site Porto Virtual', 'portovirtual.com.br', TO_BASE64(SHA1(CONCAT('Site Porto Virtual', NOW())))),
('Site 4sr', '4sr.com.br', TO_BASE64(SHA1(CONCAT('Site 4sr', NOW()))));
