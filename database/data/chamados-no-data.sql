-- MySQL dump 10.19  Distrib 10.3.35-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: chamados
-- ------------------------------------------------------
-- Server version	10.3.35-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `chamados`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `chamados` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `chamados`;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `setor` int(11) DEFAULT NULL,
  `cidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aniversario` timestamp NULL DEFAULT NULL,
  `nome_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1078 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `audits`
--

DROP TABLE IF EXISTS `audits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint(20) unsigned NOT NULL,
  `old_values` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_values` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(1023) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  KEY `audits_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=95101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `chamados`
--

DROP TABLE IF EXISTS `chamados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chamados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `protocolo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_abertura` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_fechamento` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Novo',
  `tempo` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contato` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prioridade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comentario` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nome_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempo_total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempo_pausado` time DEFAULT '00:00:00',
  `tempo_atendimento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `motivos_id` bigint(20) unsigned NOT NULL,
  `clientes_id` bigint(20) unsigned NOT NULL,
  `users_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_designacao` (`designacao`),
  KEY `fk_clientes_id` (`clientes_id`),
  KEY `fk_motivos` (`motivos_id`),
  CONSTRAINT `fk_clientes_id` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_designacao` FOREIGN KEY (`designacao`) REFERENCES `cliente_tecnicos` (`designacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_motivos` FOREIGN KEY (`motivos_id`) REFERENCES `motivos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9090 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cidades`
--

DROP TABLE IF EXISTS `cidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cidades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sigla_estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capital` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `circuito_equipamentos`
--

DROP TABLE IF EXISTS `circuito_equipamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `circuito_equipamentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_tecnico_id` bigint(20) unsigned NOT NULL,
  `equipamento_id` bigint(20) unsigned NOT NULL,
  `patrimonio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fabricante` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cliente_tecnico_agosto`
--

DROP TABLE IF EXISTS `cliente_tecnico_agosto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente_tecnico_agosto` (
  `id` varchar(5) DEFAULT NULL,
  `circuito` varchar(58) DEFAULT NULL,
  `cnpj_cpf` varchar(18) DEFAULT NULL,
  `dt_abertura` varchar(11) DEFAULT NULL,
  `dt_previsao_inicial` varchar(19) DEFAULT NULL,
  `dt_instalacao` varchar(13) DEFAULT NULL,
  `dt_entregue_fin` varchar(15) DEFAULT NULL,
  `situacao` varchar(8) DEFAULT NULL,
  `contrato` varchar(8) DEFAULT NULL,
  `vlr_mensal` varchar(10) DEFAULT NULL,
  `vlr_ativacao` varchar(12) DEFAULT NULL,
  `prazo_contrato` varchar(14) DEFAULT NULL,
  `gerente` varchar(7) DEFAULT NULL,
  `velocidade` varchar(10) DEFAULT NULL,
  `link` varchar(4) DEFAULT NULL,
  `ip` varchar(10) DEFAULT NULL,
  `meio` varchar(5) DEFAULT NULL,
  `interface_a` varchar(29) DEFAULT NULL,
  `interface_b` varchar(29) DEFAULT NULL,
  `endereco_ponto_a` varchar(111) DEFAULT NULL,
  `estado` varchar(6) DEFAULT NULL,
  `cidade` varchar(25) DEFAULT NULL,
  `endereco_ponto_b` varchar(65) DEFAULT NULL,
  `estado_ponto_b` varchar(14) DEFAULT NULL,
  `cidade_ponto_b` varchar(14) DEFAULT NULL,
  `designacao` varchar(13) DEFAULT NULL,
  `id_operadora` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cliente_tecnico_uploads`
--

DROP TABLE IF EXISTS `cliente_tecnico_uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente_tecnico_uploads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_log` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8050 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cliente_tecnicos`
--

DROP TABLE IF EXISTS `cliente_tecnicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente_tecnicos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `circuito` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnpj_cpf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gerente` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `velocidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interface_a` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interface_b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco_ponto_a` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco_ponto_b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_ponto_b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade_ponto_b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_operadora` int(11) DEFAULT NULL,
  `pre_venda` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_cliente` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dt_abertura` datetime DEFAULT NULL,
  `dt_previsao_inicial` datetime DEFAULT NULL,
  `dt_instalacao` datetime DEFAULT NULL,
  `dt_entregue_fin` datetime DEFAULT NULL,
  `dias` int(11) DEFAULT NULL,
  `dias_situacao_pendencia_cliente` int(11) DEFAULT NULL,
  `situacao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contrato` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vlr_mensal` decimal(10,2) DEFAULT NULL,
  `vlr_ativacao` decimal(10,2) DEFAULT NULL,
  `prazo_contrato` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vlr_total` decimal(10,2) DEFAULT NULL,
  `fornecedor_cnpj_parceiro` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fornecedor_nome_parceiro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fornecedor_email_suporte` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fornecedor_telefone_suporte` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fornecedor_tipo_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fornecedor_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fornecedor_meio_entrega` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fornecedor_velocidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fornecedor_designacao_parceiro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fornecedor_email_financeiro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fornecedor_telefone_financeiro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fornecedor_valor_mensalidade` decimal(10,2) DEFAULT NULL,
  `fornecedor_valor_instalacao` decimal(10,2) DEFAULT NULL,
  `fornecedor_data_vencimento_fatura` int(11) DEFAULT NULL,
  `fornecedor_data_vigencia_contrato` int(11) DEFAULT NULL,
  `fornecedor_data_assinatura_contrato` date DEFAULT NULL,
  `fornecedor_observacoes` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fornecedor_data_prevista_instalacao` date DEFAULT NULL,
  `fornecedor_data_agendamento_cliente` date DEFAULT NULL,
  `fornecedor_data_agendamento_parceiro` date DEFAULT NULL,
  `fornecedor_data_conclusao` date DEFAULT NULL,
  `fornecedor_dados_tecnicos` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visualizado` tinyint(1) DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `protecao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prazo_data_limite_ativacao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `circuito_em_atrasado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cliente_tecnicos_designacao_unique` (`designacao`),
  KEY `fk_velocidade` (`velocidade`),
  KEY `fk_links_desc` (`link`),
  CONSTRAINT `fk_links_desc` FOREIGN KEY (`link`) REFERENCES `links` (`descricao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_velocidade` FOREIGN KEY (`velocidade`) REFERENCES `velocidades` (`descricao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24603 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cliente_tecnicos_bkp`
--

DROP TABLE IF EXISTS `cliente_tecnicos_bkp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente_tecnicos_bkp` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `circuito` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnpj_cpf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gerente` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `velocidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interface_a` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interface_b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco_ponto_a` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco_ponto_b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_ponto_b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade_ponto_b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pre_venda` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_operadora` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dt_abertura` datetime DEFAULT NULL,
  `dt_previsao_inicial` datetime DEFAULT NULL,
  `dt_instalacao` datetime DEFAULT NULL,
  `dt_entregue_fin` datetime DEFAULT NULL,
  `dias` int(11) DEFAULT NULL,
  `situacao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contrato` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vlr_mensal` decimal(10,2) DEFAULT NULL,
  `vlr_ativacao` decimal(10,2) DEFAULT NULL,
  `prazo_contrato` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vlr_total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cliente_tecnicos_bkp_designacao_unique` (`designacao`)
) ENGINE=InnoDB AUTO_INCREMENT=21374 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fantasia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnpj_cpf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contato` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone_fin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_fin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo_cliente` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comentario` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cnpj_cpf` (`cnpj_cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=2230 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comentario_chamados`
--

DROP TABLE IF EXISTS `comentario_chamados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentario_chamados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_chamado` int(11) NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comentario` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nome_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_chamado` int(11) NOT NULL DEFAULT 0,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `minutos_corridos` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30211 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contrato_designacaos`
--

DROP TABLE IF EXISTS `contrato_designacaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contrato_designacaos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contrato_id` bigint(20) unsigned NOT NULL,
  `designacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contratos`
--

DROP TABLE IF EXISTS `contratos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contratos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` bigint(20) unsigned NOT NULL,
  `contrato` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj_cpf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `datas`
--

DROP TABLE IF EXISTS `datas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `datas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt_data` datetime DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4384 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `designacaos`
--

DROP TABLE IF EXISTS `designacaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `designacaos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sequencial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `equipamentos`
--

DROP TABLE IF EXISTS `equipamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipamentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `equipamento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fabricante` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sigla` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fornecedor_cidades`
--

DROP TABLE IF EXISTS `fornecedor_cidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedor_cidades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cnpj_fornecedor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cnpj_fornecedor` (`cnpj_fornecedor`,`uf`,`cidade`)
) ENGINE=InnoDB AUTO_INCREMENT=1142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fornecedors`
--

DROP TABLE IF EXISTS `fornecedors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_fantasia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnpj_cpf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inscricao_estadual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `telefone_suporte` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_suporte` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone_financeiro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_financeiro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anotacao` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cnpj_cpf` (`cnpj_cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=1802 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_links_descricao` (`descricao`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log_cliente_tecnicos`
--

DROP TABLE IF EXISTS `log_cliente_tecnicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_cliente_tecnicos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `situacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comentario` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_abertura` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cliente_tec_desig` (`designacao`),
  CONSTRAINT `fk_cliente_tec_desig` FOREIGN KEY (`designacao`) REFERENCES `cliente_tecnicos` (`designacao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21491 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meios`
--

DROP TABLE IF EXISTS `meios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `motivos`
--

DROP TABLE IF EXISTS `motivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `motivos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `operadora`
--

DROP TABLE IF EXISTS `operadora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operadora` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obrigatorio` tinyint(1) DEFAULT 1 COMMENT '0 = true / 1 = false',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10498 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rede_interfaces`
--

DROP TABLE IF EXISTS `rede_interfaces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rede_interfaces` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `saldo_receber`
--

DROP TABLE IF EXISTS `saldo_receber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saldo_receber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mes` varchar(255) NOT NULL,
  `Vlr_Mensal` decimal(19,2) DEFAULT NULL,
  `Qtd_Mensal` int(11) DEFAULT NULL,
  `Vlr_Ativacao` decimal(19,2) DEFAULT NULL,
  `Qtd_Ativacoes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_mes` (`mes`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `situacao_circuitos`
--

DROP TABLE IF EXISTS `situacao_circuitos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `situacao_circuitos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `situacao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_temp`
--

DROP TABLE IF EXISTS `tbl_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_temp` (
  `id` bigint(20) unsigned NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tempo_chamado`
--

DROP TABLE IF EXISTS `tempo_chamado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tempo_chamado` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_chamado` bigint(20) NOT NULL,
  `data_abertura` timestamp NULL DEFAULT NULL,
  `data_pausa` timestamp NULL DEFAULT NULL,
  `tempo_corrido` float DEFAULT NULL,
  `id_audits` bigint(20) NOT NULL,
  `tempo_total` float DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_audits` (`id_audits`)
) ENGINE=InnoDB AUTO_INCREMENT=18301 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tmp_cidade`
--

DROP TABLE IF EXISTS `tmp_cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmp_cidade` (
  `id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `designacao` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nova_CIDADE` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_values` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '$2y$10$TH9BihaPBtpj2E66UE5ChuxJvcockkpHp5.yrj8lSeSYC95ZCkXsm',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `setor` int(11) DEFAULT NULL,
  `cidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aniversario` timestamp NULL DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nome_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `perfil` int(11) DEFAULT NULL,
  `perfil_gerente_contas_or_pre_venda` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `velocidades`
--

DROP TABLE IF EXISTS `velocidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `velocidades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `convert_byte` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_vel_descricao` (`descricao`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `vw_gerente_valor_total_ano`
--

DROP TABLE IF EXISTS `vw_gerente_valor_total_ano`;
/*!50001 DROP VIEW IF EXISTS `vw_gerente_valor_total_ano`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `vw_gerente_valor_total_ano` (
  `vlr_total` tinyint NOT NULL,
  `gerente` tinyint NOT NULL,
  `dt_abertura` tinyint NOT NULL,
  `dt_data` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Current Database: `chamados`
--

USE `chamados`;

--
-- Final view structure for view `vw_gerente_valor_total_ano`
--

/*!50001 DROP TABLE IF EXISTS `vw_gerente_valor_total_ano`*/;
/*!50001 DROP VIEW IF EXISTS `vw_gerente_valor_total_ano`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_gerente_valor_total_ano` AS select coalesce(sum(`cliente_tecnicos`.`vlr_total`),0) AS `vlr_total`,`cliente_tecnicos`.`gerente` AS `gerente`,str_to_date(concat(date_format(`cliente_tecnicos`.`dt_abertura`,'%Y'),'-01-01'),'%Y-%m-%d') AS `dt_abertura`,`dt`.`dt_data` AS `dt_data` from (((select distinct str_to_date(concat(date_format(`datas`.`dt_data`,'%Y'),'-01-01'),'%Y-%m-%d') AS `dt_data` from `datas`)) `dt` left join `cliente_tecnicos` on(`dt`.`dt_data` = str_to_date(concat(date_format(`cliente_tecnicos`.`dt_abertura`,'%Y'),'-01-01'),'%Y-%m-%d'))) where (`cliente_tecnicos`.`situacao` <> '' or `cliente_tecnicos`.`situacao` is null) and (`cliente_tecnicos`.`situacao` <> 'CANCELADA' or `cliente_tecnicos`.`situacao` is null) and (`cliente_tecnicos`.`situacao` <> 'CANCELADO' or `cliente_tecnicos`.`situacao` is null) and (`cliente_tecnicos`.`situacao` <> 'Contrato Cancelado' or `cliente_tecnicos`.`situacao` is null) and (`cliente_tecnicos`.`situacao` <> 'Inviável' or `cliente_tecnicos`.`situacao` is null) and (`cliente_tecnicos`.`situacao` <> 'Inativo' or `cliente_tecnicos`.`situacao` is null) and (`cliente_tecnicos`.`situacao` <> 'Null' or `cliente_tecnicos`.`situacao` is null) and (`cliente_tecnicos`.`situacao` <> 'Oportunidade' or `cliente_tecnicos`.`situacao` is null) and (`cliente_tecnicos`.`situacao` <> 'Proposta Enviada' or `cliente_tecnicos`.`situacao` is null) and (`cliente_tecnicos`.`situacao` <> 'Proposta Reprovada' or `cliente_tecnicos`.`situacao` is null) and (`cliente_tecnicos`.`situacao` <> 'Viável' or `cliente_tecnicos`.`situacao` is null) and (`cliente_tecnicos`.`situacao` <> 'Viabilidade Técnica' or `cliente_tecnicos`.`situacao` is null) and `cliente_tecnicos`.`dt_abertura` is not null group by `cliente_tecnicos`.`gerente`,`cliente_tecnicos`.`gerente`,str_to_date(concat(date_format(`cliente_tecnicos`.`dt_abertura`,'%Y'),'-01-01'),'%Y-%m-%d') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-10 14:15:43
